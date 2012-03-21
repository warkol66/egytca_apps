// ==============================================================================
//                     JavaScript Form Validation Libarary
// ==============================================================================
// a DentedReality Production 2001,2002,2003
// written by Beau Lebens <beau@dentedreality.com.au>
// See: http://www.dentedreality.com.au/jsvalidation/
// Version 1.3

// Validate the fields on a form using specific, custom attributes
// required="true" => this field must have something in it. Use this
//	in combination with another rule normally.
// validate="true" => validate this field, provided it has a rule
// rule="rule" => use the rule specified to validate this input "value"
//	Options for "rule":
//		"txt"		= Text Only (and spaces)
//		"num"		= Numbers Only (allow decimal)
//		"int"		= Integers only
//		"phone" 	= Phone number, (0-9()-+)
//		"date"		= Date Format (dd/mm/yyyy)
//		"email" 	= Email addresses
//		"alnum" 	= Alpha-Numeric Values
//		"curr"		= Currency ($xxxx..."."xx)
//		"addr"  	= Address characters (a-zA-Z0-9-,#)
//		"name" 		= Most likely characters in a name  (a-zA-Z,.-)
//		"free"		= Freeform text (a-zA-Z0-9+-_()[]/&)
//		"nobadsql"	= Denies harmful SQL syntax
//		"notnull"	= Must enter something
//		RegExp		= Any valid regular expression you may specify
//					ie. "/^[\d]{0,3}.[\d]{0,3}.[\d]{0,3}$/" = an IP number
// error="Extended String" => the error message if validation fails. (without a
//	newline character at the end or a bullet at the start, they are added)
// ==============================================================================


// Default Operational Values, Modify these to change default actions of
// the data validation library.

// This is the rule to use to validate a value if none is specified.
var defaultValidationRule	= "free";

// This is the first part of the error message, set to blank to just show a list
// of errors.
var defaultErrorPrefix	= "This form cannot be submitted with the following errors;\n";

// [ELEMENT] is replaced with the field name when displayed.
var defaultErrorMessage	= "The value in the '[ELEMENT]' field is invalid.";


// ==============================================================================
//							   ACTUAL VALIDATION CODE
// ==============================================================================

// Actual code for determining and then applying a regular expression
// to the designated form element. Returns true if the pattern matches,
// false if it doesn't.
function validateField(field_name, validation_code) {
	// This is a switch used for reversing the desired regular
	// expression result.
	// Set to "true" if matching a regexp successfully should
	// result in a failure.
	invertResult = false;

	// Check if they supplied a custom RegExp or just a rule name
	if (validation_code.charAt(0) != "/") {
		// These are the pre-defined rules available, you can
		// edit this list by using one as an example.
		switch (validation_code.toLowerCase()) {
			case "txt" : 			// Text only allowed
				re = /^[a-z ]*$/i
				break;
			case "num" :			// Only numbers (allow decimal)
				re = /^[\d\.]*$/
				break;
			case "int" :			// Integers only
				re = /^\d*$/
				break;
			case "phone" :			// Phone number characters
				re = /^[\d \-\(\)\+]*$/
				break;
			case "date" :			// Well-formed Dates
				re = /^(()|(\d{1,2}(\/|-)\d{1,2}(\/|-)\d{2,4}))$/
				break;
			case "email" :			// Something valid-ish for an email
				re = /^[a-z\d\.\-_]+@[a-z\d\.\-_]{2,}\.[a-z]{2,10}$/i
				break;
			case "alnum" :			// Alpha-numeric characters
				re = /^[\w ]*$/i
				break;
			case "curr" :			// Currency (using "$", "," and ".")
				re = /^\$?\d*,?\.?\d{0,2}$/i
				break;
			case "addr" :			// Base Address rule
				re = /^[\w- \.,#]*$/gi
				break;
			case "name" :			// Good for validating names
				re = /^[a-z,\-\. ]*$/gi
				break;
			case "free" :			// Freeform, text, num and some chars
				re = /^[\w\-\+\(\)\[\]\\/&, ]*$/i
				break;
			case "nobadsql" :		// Denies SQL which could be harmful
				re = /((delete|drop|update|replace|kill|lock) )/gi
				invertResult = true;
				break;
			case "notnull" :		// Requires *anything*
				re = /.+/
				break;
			default :			// Default - See "free"
				re = /^[\w\-\+\(\)\[\]\\/&, ]*$/i
		}
	}
	
	// This means they specified a RegExp of their own, which should be
	// in the form "/<RegExp>/" and needs to be "eval"ed before using.
	else {
		re = eval(validation_code);
	}
	
	// Do the actual regular expression testing against the string
	// and return the result.
	if (re.test(field_name.value)) {
		// If this rule uses result inversion, then return the opposite
		if (invertResult == true) {
			return false;
		}
		else {
			return true;
		}
	}
	else {
		// If this rule uses result inversion, then return the opposite
		if (invertResult == true) {
			return true;
		}
		else {
			return false;
		}
	}
}



// This is the mainline function which needs to be called on form submission to
// check required fields
function validateForm(form_name) {
	masterErrorMsg = defaultErrorPrefix;
	checkedFields = new Array('', '', '');
		
	// Loop through every element in the form specified.
	for (form_element in document[form_name].elements) {
		rule = "";
		msg  = "";
		form_element = document[form_name][form_element];

		// Ensure the form element exists
		if (form_element) {
			// Make sure the field is supposed to be validated.
			if (form_element.validate && !in_array("+" + form_element.name, checkedFields)) {
				// add this field into the "checkedFields" array to avoid
				// checking it again.
				checkedFields[checkedFields.length] = "+" + form_element.name;
				
				// Set default validation rule if none is specified
				if (!form_element.rule) {
					rule = defaultValidationRule;
				}
				else {
					rule = form_element.rule;
				}
				
				// And set the default error message
				// Replaces [ELEMENT] with the field name in the default
				// error message string if it is used.
				if (!form_element.error) {
					error = defaultErrorMessage.replace('\[ELEMENT\]', form_element.name);
				}
				else {
					error = form_element.error;
				}
				
				// If the validation fails, add this error message
				// to the running message.
				if (!validateField(form_element, rule) || (form_element.required && form_element.value == "")) {
					masterErrorMsg += "  - " + error + "\n";
				}
			}
		}
	}
	
	// This checks the current error message against the default,
	// if it has been changed (which means an error occurred) then
	// it displays the error and then returns false to prevent the
	// form from being submitted.
	if (masterErrorMsg != defaultErrorPrefix) {
		// Consider implementing customisable pop-up window
		// here rather than basic alert.
		// Customise window title, colours
		alert(masterErrorMsg);
		return false;
	}
	// If the current error message is the same as the default,
	// then that means nothing has gone wrong, so just return
	// true and allow the form to be submitted and be processed
	// as per normal.
	else {
		return true;
	}
}


// Returns true or false based on whether the specified string is found
// in the array.
// This is based on the PHP function of the same name.
function in_array(stringToSearch, arrayToSearch) {
	for (s = 0; s < arrayToSearch.length; s++) {
		thisEntry = arrayToSearch[s];
		if (thisEntry.indexOf(stringToSearch) != -1) {
			return true;
			exit;
		}
	}
	return false;
}

// ==============================================================================
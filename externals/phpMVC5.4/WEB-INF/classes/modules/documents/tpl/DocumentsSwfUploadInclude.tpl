<script src="scripts/swfupload/swfupload.js" type="text/javascript"></script>
<script src="scripts/swfupload/js/fileprogress.js" type="text/javascript"></script>
<script src="scripts/swfupload/js/swfupload.swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
var swfu;
 
		SWFUpload.onload = function () {
			swfu = new SWFUpload({
				// Backend settings
				upload_url: "../../Main.php?do=documentsUpload",
				file_post_name: "document_file",
				
 
				// Flash file settings
				file_size_limit : "|-$maxUploadSize-| MB",
				
				// Seteamos el valor inicial para los tipos de archivos.
				|-if isset($documentTypes)-| 
					|-foreach from=$documentTypes key=key item=value name=it-|
						|-if $smarty.foreach.it.first-|
							file_types : "|-$value-|",
							file_types_description : "|-$key-|",
						|-/if-|
					|-/foreach-|
				|-else-|
					file_types : "*.*;",
					file_types_description : "All",
				|-/if-|
				
				file_upload_limit : "0",
				file_queue_limit : "1",
 
				// Event handler settings
				swfupload_loaded_handler : swfUploadLoaded,
				
				file_dialog_start_handler: fileDialogStart,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				
				//upload_start_handler : uploadStart,	// I could do some client/JavaScript validation here, but I don't need to.
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// SWFObject settings
				minimum_flash_version : "9.0.28",
				swfupload_pre_load_handler : swfUploadPreLoad,
				swfupload_load_failed_handler : swfUploadLoadFailed,
 
				// Button Settings
				button_image_url : "images/XPButtonUploadText_61x22.png",
				button_placeholder_id : "spanButtonPlaceholder",
				button_width: 61,
				button_height: 22,
				
				// Flash Settings
				flash_url : "scripts/swfupload/swfupload.swf",
 
				custom_settings : {
					progress_target : "fsUploadProgress",
					upload_successful : false
				},
				
				// Debug settings
				debug: false
			});
 
		};
	
		var formChecker = null;

		function swfUploadPreLoad() {
			|-if !$configModule->get('documents', useSWFUploader)-|
				swfUploadLoadFailed();
				return;
			|-/if-|
			var self = this;
			var loading = function () {
				document.getElementById("divSWFUploadUI").style.display = "none";
				document.getElementById("divLoadingContent").style.display = "";

				var longLoad = function () {
					document.getElementById("divLoadingContent").style.display = "none";
					document.getElementById("divLongLoading").style.display = "";
				};
				this.customSettings.loadingTimeout = setTimeout(function () {
						longLoad.call(self)
					},
					15 * 1000
				);
			};
			
			this.customSettings.loadingTimeout = setTimeout(function () {
					loading.call(self);
				},
				1*1000
			);
		}
		function swfUploadLoaded() {

			var self = this;
			clearTimeout(this.customSettings.loadingTimeout);
			
			document.getElementById("divSWFUploadUI").style.display = "block";
			document.getElementById("divLoadingContent").style.display = "none";
			document.getElementById("divLongLoading").style.display = "none";
			document.getElementById("divAlternateContent").style.display = "none";
			
			var btnSubmit = document.getElementById("btnSubmit");
			
			btnSubmit.onclick = doSubmit;
			btnSubmit.disabled = true;

			formChecker = window.setInterval(swfValidateForm, 1000);
			
			swfValidateForm();
		}

		function swfUploadLoadFailed() {
			clearTimeout(this.customSettings.loadingTimeout);
			document.getElementById("divSWFUploadUI").style.display = "none";
			document.getElementById("divLoadingContent").style.display = "none";
			document.getElementById("divLongLoading").style.display = "none";
			document.getElementById("divAlternateContent").style.display = "";
		}
		
		function changeTypeFileManager() {
		
			var typeField = document.getElementById('document_type');
			var option = typeField.options[typeField.selectedIndex];
			var type = option.text;

			switch(type) {
			|-foreach from=$documentTypes key=key item=value-|
			case '|-$key-|':
				swfu.setFileTypes('|-$value-|', '|-$key-|(|-$value-|)');
				break;
			|-/foreach-|
			default:
				swfu.setFileTypes('*.*','All(*.*)');
			}

			return;
		}

		function swfValidateForm() {
			var txtFileName = document.getElementById("txtFileName");
			var isValid = true;
			
			// Si estamos en edicion no hay que hacer este chequeo.
			|-if $document eq ''-|
				if (txtFileName.value === "") {
					isValid = false;
				}
			|-/if-|
			
			document.getElementById("btnSubmit").disabled = !isValid;
		}

		// Called by the submit button to start the upload
		function doSubmit(e) {
			if (formChecker != null) {
				clearInterval(formChecker);
				formChecker = null;
			}
			
			e = e || window.event;
			if (e.stopPropagation) {
				e.stopPropagation();
			}
			e.cancelBubble = true;

			var txtFileName = document.getElementById("txtFileName");
			if(txtFileName.value === "") {
				try {
					document.getElementById('documentsAdderForm').submit();
				} catch (ex) {
					alert("Error submitting form");
				}
			} else {
				try {
					swfu.setPostParams(document.getElementById('documentsAdderForm').serialize(true));
					swfu.startUpload();
				} catch (ex) {
	
				}
			}
			return false;
		}

		 // Called by the queue complete handler to submit the form
		function uploadDone() {
			//si estamos en el modulo Documents se debe hacer submit del formulario porque no se hace actualizacion por ajax.
			|-if $module eq "Documents"-|
				try {
					document.getElementById('documentsAdderForm').submit();
				} catch (ex) {
					alert("Error submitting form");
				}
			|-/if-|
		}

		function fileDialogStart() {
			var txtFileName = document.getElementById("txtFileName");
			txtFileName.value = "";

			this.cancelUpload();
		}



		function fileQueueError(file, errorCode, message)  {
			try {
				// Handle this error separately because we don't want to create a FileProgress element for it.
				switch (errorCode) {
				case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
					alert("You have attempted to queue too many files.\n" + (message === 0 ? "You have reached the upload limit." : "You may select " + (message > 1 ? "up to " + message + " files." : "one file.")));
					return;
				case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
					alert("El archivo seleccionado es muy grande.");
					this.debug("Error: Archivo muy grande, archivo: " + file.name + ", Tamaño: " + file.size + ", Mensaje: " + message);
					return;
				case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
					alert("El archivo está vacío. Seleccione otro archivo.");
					this.debug("Error: Archivo vacío; Archivo: " + file.name + ", Tamaño: " + file.size + ", Mensaje: " + message);
					return;
				case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
					alert("El tipo de archivo a subir no está permitido.");
					this.debug("Error: Tipo inválido; Archivo: " + file.name + ", Tamaño: " + file.size + ", Mensaje: " + message);
					return;
				default:
					alert("Ha ocurrido un error. Intente mas tarde nuevamanete.");
					this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
					return;
				}
			} catch (e) {
			}
		}

		function fileQueued(file) {
			try {
				var txtFileName = document.getElementById("txtFileName");
				txtFileName.value = file.name;
			} catch (e) {
			}

		}
		function fileDialogComplete(numFilesSelected, numFilesQueued) {
			swfValidateForm();
		}

		function uploadProgress(file, bytesLoaded, bytesTotal) {

			try {
				var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

				file.id = "singlefile";	// This makes it so FileProgress only makes a single UI element, instead of one for each file
				var progress = new FileProgress(file, this.customSettings.progress_target);
				progress.setProgress(percent);
				progress.setStatus("Subiendo archivo...");
			} catch (e) {
			}
		}

		function uploadSuccess(file, serverData) {
			try {
				file.id = "singlefile";	// This makes it so FileProgress only makes a single UI element, instead of one for each file
				var progress = new FileProgress(file, this.customSettings.progress_target);
				progress.setComplete();
				progress.setStatus("Completado.");
				progress.toggleCancel(false);
				
				if (serverData === " ") {
					this.customSettings.upload_successful = false;
				} else {
					this.customSettings.upload_successful = true;
					$('documentsAdderForm').reset();
					|-if $module ne "Documents"-|
						$('documentList').show();
						$('noDocuments').hide();
						$$('#documentList tbody')[0].insert(serverData);
					|-/if-|
					serverData.evalScripts();
				}
				
			} catch (e) {
			}
		}

		function uploadComplete(file) {
			try {
				if (this.customSettings.upload_successful) {
					//this.setButtonDisabled(true);
					uploadDone();
				} else {
					file.id = "singlefile";	// This makes it so FileProgress only makes a single UI element, instead of one for each file
					var progress = new FileProgress(file, this.customSettings.progress_target);
					progress.setError();
					progress.setStatus("File rejected");
					progress.toggleCancel(false);
					
					var txtFileName = document.getElementById("txtFileName");
					txtFileName.value = "";
					swfValidateForm();

					alert("Ocurrió un problema subiendo el archivo.\nEl servidor no aceptó el mismo");
				}
			} catch (e) {
			}
		}

		function uploadError(file, errorCode, message) {
			try {
				
				if (errorCode === SWFUpload.UPLOAD_ERROR.FILE_CANCELLED) {
					// Don't show cancelled error boxes
					return;
				}
				
				var txtFileName = document.getElementById("txtFileName");
				txtFileName.value = "";
				swfValidateForm();
				
				// Handle this error separately because we don't want to create a FileProgress element for it.
				switch (errorCode) {
				case SWFUpload.UPLOAD_ERROR.MISSING_UPLOAD_URL:
					alert("There was a configuration error.  You will not be able to upload a resume at this time.");
					this.debug("Error Code: No backend file, File name: " + file.name + ", Message: " + message);
					return;
				case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
					alert("You may only upload 1 file.");
					this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
					return;
				case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
				case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
					break;
				default:
					alert("An error occurred in the upload. Try again later.");
					this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
					return;
				}

				file.id = "singlefile";	// This makes it so FileProgress only makes a single UI element, instead of one for each file
				var progress = new FileProgress(file, this.customSettings.progress_target);
				progress.setError();
				progress.toggleCancel(false);

				switch (errorCode) {
				case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
					progress.setStatus("Upload Error");
					this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
					break;
				case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
					progress.setStatus("Upload Failed.");
					this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
					break;
				case SWFUpload.UPLOAD_ERROR.IO_ERROR:
					progress.setStatus("Server (IO) Error");
					this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
					break;
				case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
					progress.setStatus("Security Error");
					this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
					break;
				case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
					progress.setStatus("Upload Cancelled");
					this.debug("Error Code: Upload Cancelled, File name: " + file.name + ", Message: " + message);
					break;
				case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
					progress.setStatus("Upload Stopped");
					this.debug("Error Code: Upload Stopped, File name: " + file.name + ", Message: " + message);
					break;
				}
			} catch (ex) {
			}
		}
</script>
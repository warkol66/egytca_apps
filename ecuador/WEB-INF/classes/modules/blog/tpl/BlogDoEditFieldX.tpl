|-if $isDate-|
|-$paramValue|date_format-|
|-elseif $isNumeric-|
|-$paramValue|system_numeric_format-|
|-else-|
|-$paramValue-|
|-/if-|

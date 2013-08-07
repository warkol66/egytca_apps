|-if method_exists($class, "getName")-|
[|-foreach $objects as $object-|{"value":"|-json_encode($object->getId())-|", "label":|-json_encode($object->getName())-|}|-if !$object@last-|,|-/if-|
|-/foreach-|]
|-/if-|

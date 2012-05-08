<div id="menu">
|-if $contentData.id|is_descendant:21-|
	|-if $contentData.id ne 21-||-include_module module=Content action=Title options="id=21"-||-/if-|
	|-include_module module=Content action=Menu options="noParent=0&backToParent=1&depth=4&id=21&topDepth=10&topDepthContentLimitId=21"-|
|-elseif $contentData.id|is_descendant:22-|
	|-if $contentData.id ne 22-||-include_module module=Content action=Title options="id=22"-||-/if-|
	|-include_module module=Content action=Menu options="noParent=0&backToParent=1&depth=4&id=22&topDepth=10&topDepthContentLimitId=22"-|
|-elseif $contentData.id|is_descendant:23-|
	|-if $contentData.id ne 23-||-include_module module=Content action=Title options="id=23"-||-/if-|
	|-include_module module=Content action=Menu options="noParent=0&backToParent=1&depth=4&id=23&topDepth=10&topDepthContentLimitId=23"-|
|-elseif $contentData.id|is_descendant:24-|
	|-if $contentData.id ne 24-||-include_module module=Content action=Title options="id=24"-||-/if-|
	|-include_module module=Content action=Menu options="noParent=0&backToParent=1&depth=4&id=24&topDepth=10&topDepthContentLimitId=24"-|
|-else-|
	|-include_module module=Content action=Menu options="noParent=1&depth=4&id=1"-|
|-/if-|
</div>
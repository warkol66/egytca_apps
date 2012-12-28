<table border="0">
|-section name=rows loop=$banners-|
  <tr>
    |-section name=cols loop=$banners[rows]-|
      <td>
        |-assign var="banner" value=$banners[rows][cols]-|
        |-include file="BannersDisplay.tpl"-|
      </td>
    |-/section-|
  </tr>
|-/section-|
</table>

|-if $mode eq 'preview'-|
    <br />[<a href="|-$request_uri-|">##25,Recargar##</a>]
|-/if-|

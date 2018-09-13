<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="/">
  <html>
  <head>
    <title>My Cookbook</title>
    <style type="text/css">
      h1 { font-style: italic ; color: green }
      td.prep { font-style: italic ; bgcolor: orange ; colspan: 2}
    </style>
  </head>
  <body style="text-align:center">
    <h1>My Recipe Collection</h1>
    <table border="1" width="400" align="center" >

    <xsl:for-each select="Cookbook/Recipe">
      <tr>
        <th bgcolor="pink" colspan="2"><xsl:value-of select="Index"/></th>
      </tr>
      <tr bgcolor="#9acd32">
        <th bgcolor="green" colspan="2"><xsl:value-of select="Name"/></th>
      </tr>
      <xsl:for-each select="Ingredientlist/ingredient">
      <tr>
        <td><xsl:value-of select="name"/></td>
        <td><xsl:value-of select="amount"/><xsl:value-of select="unit"/></td>
      </tr>
      </xsl:for-each>

      <tr>
        <td bgcolor="lightyellow" colspan="2">
          <p>1. <xsl:value-of select="Procedure/first"/></p>
          <p>2. <xsl:value-of select="Procedure/second"/></p>
          <p>3. <xsl:value-of select="Procedure/third"/></p>
        </td>
      </tr>

    </xsl:for-each>
    </table>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>

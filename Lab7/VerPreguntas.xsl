<?xml version="1.0"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:param name="file1" select="document('preguntas.xml')"/>

<xsl:template match="/">
  <html>
  <body>
    <h2>Mis preguntas</h2>
    <table border="1">
      <tr bgcolor="#9acd32">
        <th>Pregunta</th>
        <th>Respuesta</th>
      </tr>
      <xsl:for-each select="assessmentItems/assessmentItem">
	        <xsl:for-each select="itemBody">
				<tr>
					<td><xsl:value-of select="p"/></td></tr>
			</xsl:for-each>
	        <xsl:for-each select="correctResponse">
					<td><xsl:value-of select="value"/></td>
			</xsl:for-each>
      </xsl:for-each>
    </table>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet> 

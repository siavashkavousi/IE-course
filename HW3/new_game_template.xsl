<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="grid">
        <table>
            <xsl:for-each select="./row">
                <tr>
                    <xsl:attribute name="row">
                        <xsl:value-of select="./@row"/>
                    </xsl:attribute>
                    <xsl:for-each select="./col">
                        <td>
                            <xsl:attribute name="col">
                                <xsl:value-of select="./@col"/>
                            </xsl:attribute>
                            <xsl:attribute name="mine">
                                <xsl:value-of select="./@mine"/>
                            </xsl:attribute>
                        </td>
                    </xsl:for-each>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>
</xsl:stylesheet>
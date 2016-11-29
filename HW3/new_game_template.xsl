<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="grid">
        <xsl:for-each select="./row">
            <xsl:for-each select="./col">
                <span>
                    <xsl:attribute name="id">
                        <xsl:text>c</xsl:text>
                        <xsl:value-of select="../@row"/>
                        <xsl:value-of select="./@col"/>
                    </xsl:attribute>
                    <xsl:if test="./@mine">
                        <xsl:attribute name="data-value">
                            <xsl:text>mine</xsl:text>
                        </xsl:attribute>
                    </xsl:if>
                </span>
            </xsl:for-each>
        </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>
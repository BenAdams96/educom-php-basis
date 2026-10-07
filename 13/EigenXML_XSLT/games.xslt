<?xml version="1.0"?>

<xsl:stylesheet
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    version="1.0">

    <xsl:template match="/">

        <html>
        <body>

            <h1>Mijn games</h1>

            <xsl:for-each select="games/game">

                <div style="border: 1px solid black; padding: 10px; margin-bottom: 10px; width: 300px;">

                    <h2>
                        <xsl:value-of select="title"/>
                    </h2>

                    <p>
                        <b>Platform:</b>
                        <xsl:value-of select="@platform"/>
                    </p>

                    <p>
                        <b>Genre:</b>
                        <xsl:value-of select="genre"/>
                    </p>

                    <p>
                        <b>Jaar:</b>
                        <xsl:value-of select="year"/>
                    </p>

                    <p>
                        <b>Speeltijd:</b>
                        <xsl:value-of select="hours"/> uur
                    </p>

                    <p>
                        <b>Score:</b>
                        <xsl:value-of select="score"/> / 10
                    </p>

                    <p>
                        <b>Uitgespeeld:</b>

                        <xsl:choose>
                            <xsl:when test="@completed = 'yes'">
                                Ja
                            </xsl:when>

                            <xsl:otherwise>
                                Nee
                            </xsl:otherwise>
                        </xsl:choose>
                    </p>

                </div>

            </xsl:for-each>

        </body>
        </html>

    </xsl:template>

</xsl:stylesheet>
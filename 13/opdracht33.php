<!--
USE:

XML:
<person>
    <name>Ben</name>
    <age>29</age>
    <city>Breda</city>
    <job>Software Engineer Trainee</job>
    <hobbies>
        <hobby>Gaming</hobby>
        <hobby>Programming</hobby>
        <hobby>Fitness</hobby>
    </hobbies>
</person>


XSLT:
<xsl:stylesheet
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    version="1.0">
    <xsl:template match="/">
        <div style="font-family: Arial; border: 1px solid #ccc; padding: 15px; width: 300px;">
            <h2>
                <xsl:value-of select="person/name"/>
            </h2>
            <p>
                <b>Leeftijd:</b>
                <xsl:value-of select="person/age"/> jaar
            </p>
            <p>
                <b>Woonplaats:</b>
                <xsl:value-of select="person/city"/>
            </p>
            <p>
                <b>Werk:</b>
                <xsl:value-of select="person/job"/>
            </p>
            <h3>Hobby's</h3>
            <ul>
                <xsl:for-each select="person/hobbies/hobby">
                    <li>
                        <xsl:value-of select="."/>
                    </li>
                </xsl:for-each>
            </ul>
        </div>
    </xsl:template>
</xsl:stylesheet>
-->

<?php
$xml_input = "";
$xslt_input = "";
$output = "";

//check of formulier is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //gegevens uit de textareas ophalen
    $xml_input = $_POST["xml_input"];
    $xslt_input = $_POST["xslt_input"];

    //check of beide vakken zijn ingevuld
    if ($xml_input != "" && $xslt_input != "") {

        //xml document maken en xml inladen
        $xml_doc = new DOMDocument(); //lege XML(or HTML) class?
        $xml_doc->loadXML($xml_input);

        //xslt document maken en xslt inladen
        $xslt_doc = new DOMDocument();
        $xslt_doc->loadXML($xslt_input);

        //xslt processor maken
        $processor = new XSLTProcessor();

        //xslt stylesheet aan processor geven
        $processor->importStylesheet($xslt_doc);

        //xslt toepassen op xml
        $output = $processor->transformToXML($xml_doc);

    } else {
        $output = "Vul beide vakken in.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>XML Transformer</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        textarea {
            width: 500px;
            height: 200px;
        }

        .input {
            display: flex;
            gap: 30px;
        }

        .result {
            margin-top: 30px;
        }
    </style>
</head>

<body>

<h1>XML Transformer</h1>

<form method="post">

    <div class="input">

        <div>
            <h3>XML</h3>

            <textarea name="xml_input"><?php
                echo htmlspecialchars($xml_input);
            ?></textarea>
        </div>

        <div>
            <h3>XSLT</h3>

            <textarea name="xslt_input"><?php
                echo htmlspecialchars($xslt_input);
            ?></textarea>
        </div>

    </div>

    <br>

    <input type="submit" value="Transformeren">

</form>

<?php
if ($output != "") {
    ?>

    <div class="result">

        <h2>Resultaat</h2>

        <?php
        //resultaat van xslt laten zien
        echo $output;
        ?>

    </div>

    <?php
}
?>

</body>
</html>
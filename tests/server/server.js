"use strict";

let app = require("express")();

/* eslint complexity: "off" */
app.get("/webmill.php", function (request, response) {
    var query = request.query.qt;
    switch (query) {
        case "version":
            response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                "<eyebase_api>" +
                "<version>" +
                "<id><![CDATA[1.0.0]]></id>" +
                "<name><![CDATA[eyebase TEST API v1.0.0]]></name>" +
                "</version>" +
                "</eyebase_api>");
            break;
        case "loginstatus":
            response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                "<eyebase_api>" +
                "<message>" +
                "<id><![CDATA[120]]></id>" +
                "<text><![CDATA[User logged out.]]></text>" +
                "<eyebase_message/>" +
                "</message>" +
                "</eyebase_api>");
            break;
        case "login":
            if(request.query.ben_kennung === "api" && request.query.benutzer === "api") {
                response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                    "<eyebase_api>" +
                    "<user>" +
                    "<id ><![CDATA[2004]]></id>" +
                    "<login ><![CDATA[demo]]></login>" +
                    "<name ><![CDATA[DEMO API]]></name>" +
                    "<message ><![CDATA[Login successful]]></message>" +
                    "</user>" +
                    "</eyebase_api>");
            } else {
                response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                    "<eyebase_api>" +
                    "<error>" +
                    "<id><![CDATA[300]]></id>" +
                    "<message><![CDATA[Login error. For details see content of the eyebase_message tag.]]></message>" +
                    "<eyebase_message><![CDATA[Benutzername oder Passwort ungueltig.]]></eyebase_message>" +
                    "</error>" +
                    "</eyebase_api>");
            }
            break;
        case "logout":
            response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                "<eyebase_api>" +
                "<message>" +
                "<id ><![CDATA[100]]></id>" +
                "<text ><![CDATA[Logged out successfully.]]></text>" +
                "<eyebase_message />" +
                "</message>" +
                "</eyebase_api>");
            break;
        case "mat":
            response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                "<eyebase_api>" +
                "<mediaassettypes count=\"2\">" +
                "<mediaassettype>" +
                "<id ><![CDATA[501]]></id>" +
                "<name ><![CDATA[Bilder]]></name>" +
                "</mediaassettype>" +
                "<mediaassettype>" +
                "<id ><![CDATA[502]]></id>" +
                "<name ><![CDATA[Dokumente]]></name>" +
                "</mediaassettype>" +
                "</mediaassettypes>" +
                "</eyebase_api>");
            break;
        case "ftree":
            response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                "<eyebase_api>" +
                "<folder>" +
                "<id><![CDATA[1300]]></id>" +
                "<name><![CDATA[DEMOFOLDER]]></name>" +
                "<folderprops>" +
                "<api_token><![CDATA[TEST_TOKEN]]></api_token> " +
                "<inherit><![CDATA[on]]></inherit>" +
                "</folderprops>" +
                "<thumb/> " +
                "<web/> " +
                "<main/> " +
                "<subfolders count=\"1\">" +
                "<folder> " +
                "<id><![CDATA[1301]]></id>" +
                "<name><![CDATA[DEMO]]></name>" +
                "<folderprops>" +
                "<api_token><![CDATA[TEST_TOKEN]]></api_token>" +
                "<inherit><![CDATA[on]]></inherit>" +
                "</folderprops>" +
                "<thumb/>" +
                "<web/>" +
                "<main/>" +
                "<subfolders count=\"1\">" +
                "<folder>" +
                "<id><![CDATA[1302]]></id>" +
                "<name><![CDATA[DEMO 2]]></name>" +
                "<folderprops>" +
                "<api_token><![CDATA[TEST_TOKEN]]></api_token>" +
                "<inherit><![CDATA[on]]></inherit>" +
                "</folderprops>" +
                "<thumb/>" +
                "<web/>" +
                "<main/>" +
                "<subfolders count=\"0\"></subfolders>" +
                "</folder>" +
                "</subfolders>" +
                "</folder>" +
                "</subfolders>" +
                "</folder>" +
                "</eyebase_api>");
            break;
        case 'lang':
            response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                "<eyebase_api>" +
                "<languages count=\"1\">" +
                "<language>" +
                "<id ><![CDATA[1]]></id>" +
                "<name ><![CDATA[English]]></name>" +
                "</language>" +
                "</languages>" +
                "</eyebase_api>");
            break;
        case 'mat':
            response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                "<eyebase_api>" +
                "<mediaassettypes count=\"2\">" +
                "<mediaassettype>" +
                "<id ><![CDATA[501]]></id>" +
                "<name ><![CDATA[Bilder]]></name>" +
                "</mediaassettype>" +
                "<mediaassettype>" +
                "<id ><![CDATA[502]]></id>" +
                "<name ><![CDATA[Dokumente]]></name>" +
                "</mediaassettype>" +
                "</mediaassettypes>" +
                "</eyebase_api>");
            break;
        case 'r':
            response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                "<eyebase_api>" +
                "<mediaassets count=\"1\">" +
                "<mediaasset>" +
                "<item_id>20152</item_id>" +
                "<mediaassettype>501</mediaassettype>" +
                "<titel><![CDATA[Test]]></titel>" +
                "<titel_en><![CDATA[##directory_1.20152.2]]></titel_en>" +
                "<original_filename><![CDATA[test.jpg]]></original_filename>" +
                "<beschreibung><![CDATA[TEST]]></beschreibung>" +
                "<ordnerstruktur><![CDATA[TEST]]></ordnerstruktur>" +
                "<copyright><![CDATA[]]></copyright>" +
                "<eigentuemer><![CDATA[]]></eigentuemer>" +
                "<erstellt><![CDATA[]]></erstellt>" +
                "<erfasst><![CDATA[]]></erfasst>" +
                "<geaendert><![CDATA[25.10.2017]]></geaendert>" +
                "<quality_512>" +
                "<resolution_x>300</resolution_x>" +
                "<resolution_y>246</resolution_y>" +
                "<resolution_z/>" +
                "<size_mb>0.01</size_mb>" +
                "<checksum>d7edd821ccdf07ea7c78f999e3563d8dcaf1ce5e15b37aa2100bf3a20d1a01e4eeaf577f</checksum>" +
                "<filename_ext>.jpg</filename_ext>" +
                "<filename_name_base>00020152_w</filename_name_base>" +
                "<filename>00020152_w.jpg</filename>" +
                "<url><![CDATA[http://localhost:8082/eyebase.data/bilder/512/000/00020001_w.jpg]]></url>" +
                "</quality_512>" +
                "<picturepins/>" +
                "</mediaasset>" +
                "</mediaassets>" +
                "</eyebase_api>");
            break;
        case 'd':
            response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                "<eyebase_api>" +
                "<mediaasset>" +
                "<item_id>20152</item_id>" +
                "<mediaassettype>501</mediaassettype>" +
                "<titel><![CDATA[Test]]></titel>" +
                "<titel_en><![CDATA[##directory_1.20152.2]]></titel_en>" +
                "<original_filename><![CDATA[test.jpg]]></original_filename>" +
                "<beschreibung><![CDATA[TEST]]></beschreibung>" +
                "<ordnerstruktur><![CDATA[TEST]]></ordnerstruktur>" +
                "<copyright><![CDATA[]]></copyright>" +
                "<eigentuemer><![CDATA[]]></eigentuemer>" +
                "<erstellt><![CDATA[]]></erstellt>" +
                "<erfasst><![CDATA[]]></erfasst>" +
                "<geaendert><![CDATA[25.10.2017]]></geaendert>" +
                "<quality_512>" +
                "<resolution_x>300</resolution_x>" +
                "<resolution_y>246</resolution_y>" +
                "<resolution_z/>" +
                "<size_mb>0.01</size_mb>" +
                "<checksum>d7edd821ccdf07ea7c78f999e3563d8dcaf1ce5e15b37aa2100bf3a20d1a01e4eeaf577f</checksum>" +
                "<filename_ext>.jpg</filename_ext>" +
                "<filename_name_base>00020152_w</filename_name_base>" +
                "<filename>00020152_w.jpg</filename>" +
                "<url><![CDATA[http://localhost:8082/eyebase.data/bilder/512/000/00020001_w.jpg]]></url>" +
                "</quality_512>" +
                "<picturepins/>" +
                "</mediaasset>" +
                "</eyebase_api>");
            break;
    }
});

let server = app.listen(8082, function () {
    const host = "localhost";
    const port = server.address().port;

    console.log("Testing server listening at http://%s:%s", host, port); // eslint-disable-line no-console
});

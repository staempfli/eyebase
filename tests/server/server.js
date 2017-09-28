"use strict";

let app = require("express")();

/* eslint complexity: "off" */
app.get("/api/1/webmill.php", function (request, response) {
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
                    "<id><![CDATA[anonymous]]></id>" +
                    "<login><![CDATA[api]]></login>" +
                    "<name><![CDATA[user api]]></name>" +
                    "<message><![CDATA[Login successful]]></message>" +
                    "</user>" +
                    "</eyebase_api>");
            } else {
                response.end("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>" +
                    "<eyebase_api>" +
                    "<user>" +
                    "<id><![CDATA[anonymous]]></id>" +
                    "<message><![CDATA[Login failed]]></message>" +
                    "</user>" +
                    "</eyebase_api>");
            }
            break;
    }
});

let server = app.listen(8082, function () {
    const host = "localhost";
    const port = server.address().port;

    console.log("Testing server listening at http://%s:%s", host, port); // eslint-disable-line no-console
});
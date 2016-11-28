// Test Funcs
// See Inspect Element's Console Log Output
(function () {
    "use strict";

    let game_id;
    let game_title;
    let levels;

    function renderElements() {
        let body = document.getElementsByTagName("body")[0];

        let modal = renderModal();
        let gameWindow = renderGameWindow();

        body.appendChild(modal);
        body.appendChild(gameWindow);
    }

    function renderModal() {
        let modal = document.createElement("div");
        modal.className = "modal";

        let modalContent = document.createElement("div");
        modalContent.className = "modal-content";
        modal.appendChild(modalContent);

        let inputField = document.createElement("input");
        inputField.className = "field";
        inputField.id = "name";
        inputField.placeHolder = "Enter your name";

        let okButton = document.createElement("button");
        okButton.innerHTML = "OK";

        modalContent.appendChild(inputField);
        modalContent.appendChild(okButton);

        return modal;
    }

    function renderGameWindow() {
        let gameWindow = document.createElement("div");
        gameWindow.className = "window";

        let titleBar = (function () {
            let titleBar = document.createElement("div");
            titleBar.className = "title-bar";

            let gameTitle = document.createElement("span");
            gameTitle.id = "game-title";
            gameTitle.innerHTML = "Minesweeper Online - Beginner!";

            let btnContainer = document.createElement("div");

            let btns = [];
            for (let i = 0; i < 2; i++) {
                btns[i] = document.createElement("span");
                btns[i].className = "btn";
                btnContainer.appendChild(btns[i])
            }
            btns[0].id = "btn-minimize";
            btns[1].id = "btn-close";

            titleBar.appendChild(gameTitle);
            titleBar.appendChild(btnContainer);

            return titleBar;
        }());

        let topPart = (function () {
            let topPart = document.createElement("div");
            topPart.className = "top";

            let counter1 = document.createElement("span");
            counter1.className = "counter";
            counter1.innerHTML = 123;

            let smile = document.createElement("span");
            smile.className = "smile";
            smile.setAttribute("data", "value: 'normal'");
            smile.addEventListener("click", newGame);

            let counter2 = document.createElement("span");
            counter2.className = "counter";
            counter2.innerHTML = 321;

            topPart.appendChild(counter1);
            topPart.appendChild(smile);
            topPart.appendChild(counter2);

            return topPart;
        }());

        let grid = (function () {
            let grid = document.createElement("div");
            grid.className = "grid";
            window.onload = newGame;
            return grid;
        }());

        gameWindow.appendChild(titleBar);
        gameWindow.appendChild(topPart);
        gameWindow.appendChild(grid);

        return gameWindow;
    }

    function parseXmlString(xml_str) {
        let parser = new DOMParser();
        let xmlDoc = parser.parseFromString(xml_str, "text/xml");
        let game = xmlDoc.getElementsByTagName("game")[0];
        let id = game.getAttribute('id');
        let title = game.getAttribute('title');
        let game_levels = [];
        let levels = game.getElementsByTagName("levels")[0];
        let level_list = levels.getElementsByTagName("level");
        for (let l = 0; l < level_list.length; l++) {
            let level = level_list[l];
            let level_id = level.getAttribute("id");
            let level_title = level.getAttribute("title");
            let timer = level.getAttribute("timer");
            let rows = level.getElementsByTagName("rows")[0];
            let cols = level.getElementsByTagName("cols")[0];
            let mines = level.getElementsByTagName("mines")[0];
            let time = level.getElementsByTagName("time")[0];

            let game_level = {
                "id": level_id,
                "title": level_title,
                "timer": timer,
                "row": rows.childNodes[0].nodeValue,
                "col": cols.childNodes[0].nodeValue,
                "mines": mines.childNodes[0].nodeValue,
                "time": time.childNodes[0].nodeValue
            };
            game_levels.push(game_level);
        }

        // assign necessary vars to global vars
        game_id = id;
        game_title = title;
        levels = game_levels;
    }

    function newGame() {
        var requestXML = `
                <request>
                <rows>3</rows>
                <cols>3</cols>
                <mines>3</mines>
                </request>
                `;
        getNewGame(requestXML, function (xml_str) {
            // Process and convert xmlStr to DOM using XSLTProcessor
            let xsltProcessor = new XSLTProcessor();
            let domParser = new DOMParser();
            let xmlStrDoc = domParser.parseFromString(xml_str, "text/xml").childNodes[0];
            let templateDoc = domParser.parseFromString(makeXSL(), "text/xml").childNodes[0];
            xsltProcessor.importStylesheet(templateDoc);
            let resultDocument = xsltProcessor.transformToFragment(xmlStrDoc, document);
            document.getElementsByClassName('grid')[0].appendChild(resultDocument);
        });
    }

    function makeXSL() {
        return `
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
            </xsl:stylesheet>`;
    }

    function setGameTitle(){
        document.getElementById("game-title").innerHTML = game_title;
    }

    getGameXML(parseXmlString);
    renderElements();
    setGameTitle();
}());
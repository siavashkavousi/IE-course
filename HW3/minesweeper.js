// Test Funcs
// See Inspect Element's Console Log Output
(function () {
    "use strict";

    let DEBUG = true;
    let log = DEBUG ? console.log.bind(console) : function () {
    };

    let game_id;
    let game_title;
    let game_current_level;
    let game_levels;

    let cell_neighbor_mines = [];
    let flagged_cell = 0;
    let timer;

    function renderElements() {
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
                smile.setAttribute("data-value", "normal");

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
                return grid;
            }());

            gameWindow.appendChild(titleBar);
            gameWindow.appendChild(topPart);
            gameWindow.appendChild(grid);

            return gameWindow;
        }

        let body = document.getElementsByTagName("body")[0];

        let modal = renderModal();
        let gameWindow = renderGameWindow();

        body.appendChild(modal);
        body.appendChild(gameWindow);
    }

    function parseXmlString(xml_str) {
        let parser = new DOMParser();
        let xmlDoc = parser.parseFromString(xml_str, "text/xml");
        let game = xmlDoc.getElementsByTagName("game")[0];
        let id = game.getAttribute('id');
        let title = game.getAttribute('title');
        let levels_list = [];
        let levels = game.getElementsByTagName("levels")[0];
        let default_level = levels.getAttribute("default");
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
                "rows": rows.childNodes[0].nodeValue,
                "cols": cols.childNodes[0].nodeValue,
                "mines": mines.childNodes[0].nodeValue,
                "time": time.childNodes[0].nodeValue
            };
            levels_list.push(game_level);
        }

        log('** processed xml results **');
        log('game id: ' + id);
        log('game title: ' + title);
        log('default level: ' + default_level);
        log('game levels:');
        log(levels_list);
        log('--------------------');

        // assign necessary vars to global vars
        game_id = id;
        game_title = title;
        game_current_level = default_level;
        game_levels = levels_list;
    }

    function newGame(level_type) {
        function generateLevelInfo(level_type) {
            function findAppropriateLevel(level_type) {
                for (let i = 0; i < game_levels.length; i++) {
                    if (game_levels[i]["title"] == level_type)
                        return i + 1;
                }
            }

            if (!game_current_level)
                game_current_level = 1;
            if (level_type)
                game_current_level = findAppropriateLevel(level_type);

            let rows = game_levels[game_current_level - 1]["rows"];
            let cols = game_levels[game_current_level - 1]["cols"];
            let mines = game_levels[game_current_level - 1]["mines"];
            var requestXML = `
                <request>
                <rows>${rows}</rows>
                <cols>${cols}</cols>
                <mines>${mines}</mines>
                </request>
                `;

            log('** xml level information - request xml **');
            log(requestXML);
            log('--------------------');

            return requestXML;
        }

        function convertXml2Html(xml_str) {
            let xsltProcessor = new XSLTProcessor();
            let domParser = new DOMParser();
            let xmlStrDoc = domParser.parseFromString(xml_str, "text/xml").childNodes[0];
            let templateDoc = domParser.parseFromString(makeXSL(), "text/xml").childNodes[0];
            xsltProcessor.importStylesheet(templateDoc);
            let resultDocument = xsltProcessor.transformToFragment(xmlStrDoc, document);
            document.getElementsByClassName('grid')[0].appendChild(resultDocument);
        }

        function makeXSL() {
            return `
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
            </xsl:stylesheet>`;
        }

        var requestXML = generateLevelInfo(level_type);
        getNewGame(requestXML, convertXml2Html);
        addGridCellsEvents();
        setTimer();
        updateTimer();
        setGameOver();
        setCounter();
        calculateNeighborMines();
    }

    function getCells() {
        let grid_el = document.getElementsByClassName("grid")[0];
        return grid_el.getElementsByTagName("span");
    }

    function attachGridCellsEvents(events) {
        let cells = getCells();
        for (let c = 0; c < cells.length; c++) {
            events(cells[c]);
        }
    }

    function addGridCellsEvents() {
        attachGridCellsEvents(function (cell) {
            cell.addEventListener("mousedown", function (event) {
                if (event.button == 0)
                    this.className = "active";
            });
            cell.addEventListener("mouseup", doMouseLeftActions);
            cell.addEventListener("mouseup", doMouseRightActions);
        });
    }

    function doMouseLeftActions(event) {
        function revealNeighbors(row, col) {
            try {
                let rows = game_levels[game_current_level - 1]["rows"];
                let cols = game_levels[game_current_level - 1]["cols"];
                if (row < 1 || col < 1 || row > rows || col > cols)
                    return;
                let cell = document.getElementById(`c${row}${col}`);
                if (cell.getAttribute("class") == "revealed")
                    return;
                if (cell.getAttribute("data-value") != "mine") {
                    if (cell.getAttribute("class") != "flagged")
                        cell.className = "revealed";

                    if (cell_neighbor_mines[`c${row}${col}`] != 0) {
                        cell.setAttribute("data-value", cell_neighbor_mines[`c${row}${col}`]);
                        return;
                    }

                    revealNeighbors(row - 1, col - 1);
                    revealNeighbors(row - 1, col);
                    revealNeighbors(row - 1, col + 1);
                    revealNeighbors(row, col + 1);
                    revealNeighbors(row + 1, col + 1);
                    revealNeighbors(row + 1, col);
                    revealNeighbors(row + 1, col - 1);
                    revealNeighbors(row, col - 1);
                }
            } catch (err) {
                // pass
            }
        }

        if (event.button == 0) {
            let row = parseInt(this.id.charAt(1)), col = parseInt(this.id.charAt(2));
            revealNeighbors(row, col);
        }
    }

    function doMouseRightActions(event) {
        function mouseRightSetEvent(cell) {
            if (flagged_cell < game_levels[game_current_level - 1]["mines"]) {
                cell.className = "flagged";
                flagged_cell++;
                setCounter();
            }
        }

        function mouseRightUnsetEvent(cell) {
            cell.removeAttribute("class");
            flagged_cell--;
            setCounter();
        }

        if (event.button == 2) {
            if (this.getAttribute("class") != "flagged") {
                mouseRightSetEvent(this);
            } else {
                mouseRightUnsetEvent(this);
            }
        }
    }

    function checkGameId() {
        if (game_id != "minesweeper") {
            alert("This is not minesweeper game BTW!")
        }
    }

    function setGameTitle() {
        document.getElementById("game-title").innerHTML = game_title;
    }

    function parseBool(val) {
        return val === true || val === "true"
    }

    function isTimerEnabled() {
        return parseBool(game_levels[game_current_level - 1]["timer"]);
    }

    function setTimer() {
        if (isTimerEnabled()) {
            var time = game_levels[game_current_level - 1]["time"];
            log(time)
        } else {
            time = 0;
        }
        document.getElementsByClassName("counter")[1].innerHTML = time;
    }

    function updateTimer() {
        if (isTimerEnabled()) {
            timer = setInterval(function () {
                document.getElementsByClassName("counter")[1].innerHTML--;
            }, 1000);
        } else {
            attachGridCellsEvents(function (cell) {
                cell.addEventListener("mouseup", function (event) {
                    if (event.button == 0)
                        document.getElementsByClassName("counter")[1].innerHTML++;
                })
            })
        }
    }

    function setGameOver() {
        if (isTimerEnabled()) {
            setTimeout(function () {
                clearInterval(timer);
                document.getElementsByClassName("smile")[0].removeAttribute("data-value");
                alert("Game over!");
                recreateGrid();
                newGame();
            }, document.getElementsByClassName("counter")[1].innerHTML * 1000)
        }
        attachGridCellsEvents(function (cell) {
            cell.addEventListener("mouseup", function (event) {
                if (event.button == 0 && this.getAttribute("data-value") == "mine") {
                    this.className = "revealed";
                    document.getElementsByClassName("smile")[0].removeAttribute("data-value");
                    alert("Game over!");
                    recreateGrid();
                    newGame()
                }
            })
        })
    }

    function setCounter() {
        let mines = game_levels[game_current_level - 1]["mines"];
        document.getElementsByClassName("counter")[0].innerHTML = mines - flagged_cell;
    }

    function removeRightClickContextMenu() {
        window.oncontextmenu = function () {
            return false;
        }
    }

    function calculateNeighborMines() {
        function calculateCellNeighborMines(cell) {
            function hasCellMine(row, col) {
                try {
                    let cell = document.getElementById(`c${row}${col}`);
                    return cell.getAttribute("data-value") == 'mine';
                } catch (err) {
                    return false;
                }
            }

            if (cell.getAttribute("data-value") != "mine") {
                let rows = game_levels[game_current_level - 1]["rows"];
                let cols = game_levels[game_current_level - 1]["cols"];
                let row = parseInt(cell.id.charAt(1)), col = parseInt(cell.id.charAt(2));

                let total_mines = 0;
                if (hasCellMine(row - 1, col - 1))
                    total_mines++;
                if (hasCellMine(row - 1, col))
                    total_mines++;
                if (hasCellMine(row - 1, col + 1))
                    total_mines++;
                if (hasCellMine(row, col + 1))
                    total_mines++;
                if (hasCellMine(row + 1, col + 1))
                    total_mines++;
                if (hasCellMine(row + 1, col))
                    total_mines++;
                if (hasCellMine(row + 1, col - 1))
                    total_mines++;
                if (hasCellMine(row, col - 1))
                    total_mines++;

                cell_neighbor_mines[`c${row}${col}`] = total_mines;
            }
        }

        let cells = getCells();
        for (let c = 0; c < cells.length; c++) {
            calculateCellNeighborMines(cells[c])
        }
    }

    function startNewLevel() {
        let smile_el = document.getElementsByClassName("smile")[0];
        smile_el.addEventListener("click", function () {
            let level_type = prompt("please enter level type: (beginner, medium, hard)");
            recreateGrid();
            newGame(level_type);
        })
    }

    function recreateGrid() {
        let current_grid = document.getElementsByClassName("grid")[0];
        current_grid.parentNode.removeChild(current_grid);

        let body = document.getElementsByClassName("window")[0];
        let grid = document.createElement("div");
        grid.className = "grid";
        body.appendChild(grid)
    }

    function setUserName() {
        function doTheMagic() {
            let username = document.createElement("p");
            if (/^[A-Za-z]+$/.test(input.value)) {
                username.innerHTML = input.value;
                modal_content.replaceChild(username, input);
                modal_content.removeChild(button);
            }
        }

        let modal_content = document.getElementsByClassName("modal-content")[0];
        let button = modal_content.getElementsByTagName("button")[0];
        let input = document.getElementById("name");
        button.addEventListener("click", doTheMagic);
        input.addEventListener("keydown", function (event) {
            if (event.key == 'Enter')
                doTheMagic()
        });
    }

    removeRightClickContextMenu();

    getGameXML(parseXmlString);
    renderElements();
    checkGameId();
    setGameTitle();
    setUserName();

    newGame();
    startNewLevel();
}());
// Test Funcs
// See Inspect Element's Console Log Output
(function () {
    "use strict";

    getNewGame(`
    <request>
    <rows>3</rows>
    <cols>3</cols>
    <mines>3</mines>
    </request>
    `);

    var renderElements = function () {
        var body = document.getElementsByTagName("body")[0];

        var modal = renderModal();
        var gameWindow = renderGameWindow();

        body.appendChild(modal);
        body.appendChild(gameWindow);
    };

    var renderModal = function () {
        var modal = document.createElement("div");
        modal.className = "modal";

        var modalContent = document.createElement("div");
        modalContent.className = "modal-content";
        modal.appendChild(modalContent);

        var inputField = document.createElement("input");
        inputField.className = "field";
        inputField.id = "name";
        inputField.placeHolder = "Enter your name";

        var okButton = document.createElement("button");
        okButton.innerHTML = "OK";

        modalContent.appendChild(inputField);
        modalContent.appendChild(okButton);

        return modal;
    };

    var renderGameWindow = function () {
        var gameWindow = document.createElement("div");
        gameWindow.className = "window";

        var titleBar = (function () {
            var titleBar = document.createElement("div");
            titleBar.className = "title-bar";

            var gameTitle = document.createElement("span");
            gameTitle.id = "game-title";
            gameTitle.innerHTML = "Minesweeper Online - Beginner!";

            var btnContainer = document.createElement("div");

            var btns = [];
            for (var i = 0; i < 2; i++) {
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

        var topPart = (function () {
            var topPart = document.createElement("div");
            topPart.className = "top";

            var counter1 = document.createElement("span");
            counter1.className = "counter";
            counter1.innerHTML = 123;

            var smile = document.createElement("span");
            smile.className = "smile";
            smile.setAttribute("data", "value: 'normal'");

            var counter2 = document.createElement("span");
            counter2.className = "counter";
            counter2.innerHTML = 321;

            topPart.appendChild(counter1);
            topPart.appendChild(smile);
            topPart.appendChild(counter2);

            return topPart;
        }());

        var grid = (function () {
            var grid = document.createElement("div");
            grid.className = "grid";

            return grid;
        }());

        gameWindow.appendChild(titleBar);
        gameWindow.appendChild(topPart);
        gameWindow.appendChild(grid);

        return gameWindow;
    };

    var parseXmlString = function (xml_str) {
        var parser = new DOMParser();
        var xmlDoc = parser.parseFromString(xml_str, "text/xml");
        var game = xmlDoc.getElementsByTagName("game")[0];
        var game_id = game.id;
        var game_title = game.title;
        var game_levels = [];
        var levels = game.getElementsByTagName("levels")[0];
        var level_list = levels.getElementsByTagName("level");
        for (let l = 0; l < level_list.length; l++) {
            var level = level_list[l];
            var rows = level.getElementsByTagName("rows")[0];
            var cols = level.getElementsByTagName("cols")[0];
            var mines = level.getElementsByTagName("mines")[0];
            var time = level.getElementsByTagName("time")[0];

            var game_level = {
                "row": rows.childNodes[0].nodeValue,
                "col": cols.childNodes[0].nodeValue,
                "mines": mines.childNodes[0].nodeValue,
                "time": time.childNodes[0].nodeValue
            };
            game_levels.push(game_level);
        }

        return {
            "game_title": game_title,
            "game_id": game_id,
            "levels": game_levels
        }
    };

    getGameXML(parseXmlString);
    renderElements();
}());
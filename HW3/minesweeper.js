// Test Funcs
// See Inspect Element's Console Log Output
(function () {
    "use strict";

    getGameXML();

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

    renderElements();
}());
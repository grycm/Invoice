$(function() {

    class Map {
        constructor ()
        {
           this.sizeX = 30;
           this.sizeY = 30;
           //this.mapArray = new Array();
           this.jqueryMap = new Array();
           //this.createMap();
           this.drawMap();
           this.generateFood();
           this.snake = new Snake(this.jqueryMap[8][2], this.jqueryMap[8][1], this.jqueryMap[8][0]);
        }

        //drawing Map as table
        drawMap ()
        {
            var table = $('<table>');
            for (var i = 0; i < this.sizeX; i++) {
                this.jqueryMap[i] = new Array();
                var row = $('<tr>');
                for (var j = 0; j < this.sizeY; j++) {
                    //create new Cell, and append it's jQuery object to table
                    this.jqueryMap[i][j] = new Cell(i, j);
                    row.append(this.jqueryMap[i][j].object);
                }
                table.append(row);
            }
            $('#map').html(table);
        }

        generateFood ()
        {
            var coordX = Math.floor(Math.random() * (this.sizeX - 1));
            var coordY = Math.floor(Math.random() * (this.sizeY - 1));
            var foodCandidate = this.jqueryMap[coordX][coordY];

            if (true == foodCandidate.isSnake) {
                this.generateFood();
            } else {
                foodCandidate.isFood = true;
                foodCandidate.object.addClass('food');
            }
        }
    }

    //inside Cell there's also jQuery object, so you don't have to search
    //DOM every time you need to manipulate single cell
    class Cell
    {
        constructor (x, y)
        {
            this.x = x;
            this.y = y;
            this.isFood = false;
            this.isSnake = false;
            //jQuery object
            this.object = $('<td>');
            this.object.addClass('cell');
            this.object.attr('data-cellX', x);
            this.object.attr('data-cellY', y);
        }

    }

    //Snake's coordinates are Cell objects - wow, such OOP!
    class Snake
    {

        //new Snake needs to be 3 Cells long
        constructor (obj1, obj2, obj3)
        {
            this.coords = [obj1, obj2, obj3];
            this.direction = 'right';
            this.isTurning = false; //needed to prevent key mashing ("multiple" direction changes)
        }

        move (map, interval)
        {
            //snake's head
            var snakesHead = this.coords[0];
            var coordX = snakesHead.x;
            var coordY = snakesHead.y;

            switch (this.direction) {
                case 'right':
                    this.doOneStep(map, interval, coordX, coordY + 1);
                    break;
                case 'down':
                    this.doOneStep (map, interval, coordX + 1, coordY);
                    break;
                case 'up':
                    this.doOneStep (map, interval, coordX - 1, coordY);
                    break;
                case 'left':
                    this.doOneStep (map, interval, coordX, coordY - 1);
                    break;
            }
        }

        //add new Cell to Snake,
        //remove last from coords, and remove it's class, than draw snake
        // (just to add class to new head - may optimise it later)
        doOneStep (map, interval, coordX, coordY) {
            this.isTurning = false;

            if (coordX < 0 || coordX >= map.sizeX
                || coordY < 0 || coordY >= map.sizeY) {
                    clearInterval(interval);
                    $('#dialog').html('<h4><a href="/showAll">Wracaj do pracy;)</a></h4>'); //todo later as method
                    $('#map').addClass('blur');
                    return 0; //stop rest of method
                }
            var nextCell = map.jqueryMap[coordX][coordY];
            //eat - todo later as method
            if (true == nextCell.isFood) {
                this.coords.unshift(nextCell);
                nextCell.object.removeClass('food');
                nextCell.isFood = false;
                nextCell.object.addClass('snake');
                map.generateFood();
            } else if (true == nextCell.isSnake) {
                clearInterval(interval);
                $('#dialog').html('<h4><a href="/showAll">Wracaj do pracy;)</a></h4>'); //todo later as method
                $('#map').addClass('blur');
            } else {
                this.coords.unshift(nextCell);
                var last = this.coords.pop();
                last.object.removeClass('snake');
                last.isSnake = false;
            }
            this.draw();
        }

        //it's necessary to use it to draw Snake at least for the first time.
        //Will see, if I still use it
        draw() {
            for (var i = 0; i < this.coords.length; i++) {
                this.coords[i].object.addClass('snake');
                this.coords[i].isSnake = true;
            }
        }

    }

    var interval;
    var map = new Map();
    map.snake.draw();

    //Game Clock
    interval = setInterval(function(){
        map.snake.move(map, interval);
    },80);

    //main moving interface
    function interface (key, snake)
    {
        switch (key) {
            case 40:
              //j-turn preveniotn, key mashing preveniotn ("multiple" direction changes)
                if (snake.direction != 'up' && false == snake.isTurning) {
                    snake.isTurning = true;
                    snake.direction =  'down';
                }
                break;
            case 39:
                if (snake.direction != 'left' && false == snake.isTurning) {
                    snake.isTurning = true;
                    snake.direction =  'right';
                }
                break;
            case 37:
                if (snake.direction != 'right' && false == snake.isTurning) {
                    snake.isTurning = true;
                    snake.direction = 'left';
                }
                break;
            case 38:
                if (snake.direction != 'down' && false == snake.isTurning) {
                    snake.isTurning = true;
                    snake.direction = 'up';
                }
                break;
        }
    }

    //moving interface listener
    $(document).keyup(function(e){
        var key = e.which //pressed key
        interface(key, map.snake);
    });
});

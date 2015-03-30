// Используем шаблон "Модуль" - не засоряем глобальное пространство имён
var MYAPP = MYAPP || {};

MYAPP.changeColor = (function(){
    // IDs setInterval
    var intervalIDs = {} ;

    /**
     * Включение смены цвета
     *
     * @param selector CSS-селектор элемента, цвет которого будет меняться
     * @param interval время смены цвета
     */
    var changeOn = function(selector, interval) {
        // Массив цветов
		var colors = [
			'#FF0000', // Каждый
			'#FFA500', // охотник
			'#FFFF00', // желает
			'#00FF00', // знать
			'#87CEEB', // где
			'#0000FF', // сидит
			'#9400D3' // фазан
		];
	
		var i = 0;
	
        // Выполняем фунцкцию смены цвета по интервалу
        intervalID = setInterval(function(){
		
            // Меняем цвет (ПЛАВНО!)
            $( selector ).animate( {"background-color": colors[i]}, 'slow' );

            // Увеличиваем счётчик - переходим на след. цвет
            i++;
			
			// Если достигли конца массива, то изменяем порядок элементов и сбарысываем счётчик на 1 - чтоб не повторялся цвет
            if (i === colors.length) {
                colors.reverse();
                i = 1;
            }

            
        }, interval);

        // Одному селектору - один intervalID (для того, чтоб потом можно было выключить анимацию оперделённого selector)
        intervalIDs[ selector ] = intervalID;

        return true;
    }

    /**
     * Метод выключения смены цвета
     *
     * @param selector CSS-селектор элемента
     */
    var changeOff = function( selector ) {

        if ( intervalIDs ) {
            var id = intervalIDs[ selector ];
            if (id) {
                // Выключаем интервал
                clearInterval(intervalID);
                return true;
            }
        }
        return false;
    }

    // Общедоступные методы
    return {
        changeOn: changeOn,
        changeOff: changeOff
    }
})();
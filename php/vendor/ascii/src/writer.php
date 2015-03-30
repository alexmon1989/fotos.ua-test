<?php

/**
 * Класс для формирования строки, содержащей ASCII-таблицу 
 * на основе ассоц. массива
 */
namespace App\Ascii;

class Writer {    
    const NEWLINE = "\r\n";
    
    // Ассоц массив, из которого формируется строка
    private $arr = array();
    
    // Макс длины значений массива
    private $max_column_lengths = array();
    
    // Массив названий столбцов (названий ключей массива)
    private $headers = array();
    
    // Результ. строка
    private $result_str = '';
    

    /**
     * Конструктор класса
     * 
     * @param array $arr
     */
    public function __construct($arr) {    
        if (count($arr) > 0)
        {        
            $this->arr = $arr;

            // Массив названий ключей (столбцы "таблицы")
            if (isset($this->arr[0]))
            {
                $this->headers = array_keys($this->arr[0]);
            }

            // Макс длина имён столбцов
            $this->init_max_lengths();
        }
        else 
        {
            throw new \Exception('Empty array.');
        }
    }    

    /**
     * Установка максимальных длин полей масиива (таблицы)
     */
    private function init_max_lengths()
    {
        foreach ($this->arr as $a)
        {
            foreach ($a as $key => $value)
            {
                $len = strlen($value);
                
                if (!isset($this->max_column_lengths[$key]) 
                        or $len > $this->max_column_lengths[$key])
                {
                    $this->max_column_lengths[$key] = $len;
                }
            }
        }
    }
    
    /**
     * Добавляет горизонтальную линию таблицы (по типу +---+----+---+)
     */
    public function add_horizontal_border()
    {
        foreach ($this->headers as $value)
        {
            $this->result_str .= '+';            
            $this->result_str .= '--';
            
            for ($i = 0; $i < $this->max_column_lengths[$value]; $i++)
            {                      
                $this->result_str .= '-';  
            }
            
            $this->result_str .= '--';
        }
                
        // Закрывающий +
        $this->result_str .= '+';  
        
        // Перенос
        $this->result_str .= self::NEWLINE;     
    }
    
    /**
     * Добавление названий полей в "таблицу"
     * 
     * @param array $arr
     */
    public function add_headers()
    {                
        foreach ($this->headers as $value)
        {            
            $this->result_str .= '|';
        
            $field_name_len = strlen($value);
            $space_count = intval(($this->max_column_lengths[$value] + 4 - $field_name_len)/2);            
            // Рисуем пробелы перед названием столбца
            for ($i = 0; $i < $space_count; $i++)
            {
                $this->result_str .= ' ';
            }  
            
            // Записываем имя столбца
            $this->result_str .= $value;
            
            // Рисуем пробелы после названия столбца
            // Если что-то из двух нечётное, то добавляем один пробел
            if (($this->max_column_lengths[$value] + $field_name_len) % 2 !== 0)
            {
                $space_count += 1;
            }
            for ($i = 0; $i < $space_count; $i++)
            {
                $this->result_str .= ' ';
            }   
        }
        
        $this->result_str .= '|';
        
        // Перенос
        $this->result_str .= self::NEWLINE;     
    }
    
    /**
     * Добавление строки в таблицу
     * 
     * @param array $line Массив, из которого берутся значения для строки таблицы
     */    
    public function add_line($line)
    {
        foreach ($this->headers as $value)
        {
            $this->result_str .= '|';
            $this->result_str .= '  ';
            $this->result_str .= $line[$value];
            
            // Пробелы после значения
            $space_count = $this->max_column_lengths[$value] 
                    - strlen($line[$value]) 
                    + 2;
            for ($i = 0; $i < $space_count; $i++)
            {
                $this->result_str .= ' ';
            }
        }
        
        $this->result_str .= '|';
        
        // Перенос
        $this->result_str .= self::NEWLINE;  
    }

    /**
     * Метод для формирования строки с Ascii-таблицей
     */
    public function toAscii()
    {
        $this->result_str = '';
        $this->add_horizontal_border();
        $this->add_headers();
        $this->add_horizontal_border();
        
        foreach ($this->arr as $value)
        {
            $this->add_line($value);
            $this->add_horizontal_border();
        }        
        
        return $this->result_str;
    }
    
}
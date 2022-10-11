<?php

namespace NumberToWords\CurrencyTransformer;

class RussianCurrencyTransformerTest extends CurrencyTransformerTest
{
    public function setUp()
    {
        $this->currencyTransformer = new RussianCurrencyTransformer();
    }

    public function providerItConvertsMoneyAmountToWords()
    {
        return [
            [100, 'UAH', 'одна гривна'],
            [200, 'UAH', 'две гривны'],
            [500, 'UAH', 'пять гривен'],
            [34000, 'UAH', 'триста сорок гривен'],
            [34100, 'UAH', 'триста сорок одна гривна'],
            [34200, 'RUB', 'триста сорок два рубля'],
            [34400, 'UAH', 'триста сорок четыре гривны'],
            [34500, 'UAH', 'триста сорок пять гривен'],
            [34501, 'UAH', 'триста сорок пять гривен одна копейка'],
            [34552, 'UAH', 'триста сорок пять гривен пятьдесят две копейки'],
            [34599, 'UAH', 'триста сорок пять гривен девяносто девять копеек'],
            [234599, 'UAH', 'две тысячи триста сорок пять гривен девяносто девять копеек'],

            // rubles (RUB)
            [-2100, 'RUB', 'минус двадцать один рубль'],
            [-2125, 'RUB', 'минус двадцать один рубль двадцать пять копеек'],
            [0, 'RUB', 'ноль рублей'],
            [53, 'RUB', 'пятьдесят три копейки'],
            [100, 'RUB', 'один рубль'],
            [103, 'RUB', 'один рубль три копейки'],
            [300, 'RUB', 'три рубля'],
            [301, 'RUB', 'три рубля одна копейка'],
            [800, 'RUB', 'восемь рублей'],
            [802, 'RUB', 'восемь рублей две копейки'],
            [900, 'RUB', 'девять рублей'],
            [992, 'RUB', 'девять рублей девяносто две копейки'],
            [1000, 'RUB', 'десять рублей'],
            [1100, 'RUB', 'одиннадцать рублей'],
            [1116, 'RUB', 'одиннадцать рублей шестнадцать копеек'],
            [1200, 'RUB', 'двенадцать рублей'],
            [1900, 'RUB', 'девятнадцать рублей'],
            [2000, 'RUB', 'двадцать рублей'],
            [2100, 'RUB', 'двадцать один рубль'],
            [2500, 'RUB', 'двадцать пять рублей'],
            [5000, 'RUB', 'пятьдесят рублей'],
            [5800, 'RUB', 'пятьдесят восемь рублей'],
            [9000, 'RUB', 'девяносто рублей'],
            [9900, 'RUB', 'девяносто девять рублей'],
            [10000, 'RUB', 'сто рублей'],
            [10100, 'RUB', 'сто один рубль'],
            [10200, 'RUB', 'сто два рубля'],
            [11100, 'RUB', 'сто одиннадцать рублей'],
            [11300, 'RUB', 'сто тринадцать рублей'],
            [12000, 'RUB', 'сто двадцать рублей'],
            [12100, 'RUB', 'сто двадцать один рубль'],
            [22900, 'RUB', 'двести двадцать девять рублей'],
            [50000, 'RUB', 'пятьсот рублей'],
            [66000, 'RUB', 'шестьсот шестьдесят рублей'],
            [66600, 'RUB', 'шестьсот шестьдесят шесть рублей'],
            [90000, 'RUB', 'девятьсот рублей'],
            [90900, 'RUB', 'девятьсот девять рублей'],
            [91900, 'RUB', 'девятьсот девятнадцать рублей'],
            [99000, 'RUB', 'девятьсот девяносто рублей'],
            [99900, 'RUB', 'девятьсот девяносто девять рублей'],
            [100000, 'RUB', 'одна тысяча рублей'],
            [100100, 'RUB', 'одна тысяча один рубль'],
            [101000, 'RUB', 'одна тысяча десять рублей'],
            [101500, 'RUB', 'одна тысяча пятнадцать рублей'],
            [110000, 'RUB', 'одна тысяча сто рублей'],
            [111100, 'RUB', 'одна тысяча сто одиннадцать рублей'],
            [200000, 'RUB', 'две тысячи рублей'],
            [400000, 'RUB', 'четыре тысячи рублей'],
            [453800, 'RUB', 'четыре тысячи пятьсот тридцать восемь рублей'],
            [500000, 'RUB', 'пять тысяч рублей'],
            [502000, 'RUB', 'пять тысяч двадцать рублей'],
            [770000, 'RUB', 'семь тысяч семьсот рублей'],
            [1100000, 'RUB', 'одиннадцать тысяч рублей'],
            [1100100, 'RUB', 'одиннадцать тысяч один рубль'],
            [2100000, 'RUB', 'двадцать одна тысяча рублей'],
            [2151200, 'RUB', 'двадцать одна тысяча пятьсот двенадцать рублей'],
            [9000000, 'RUB', 'девяносто тысяч рублей'],
            [9210000, 'RUB', 'девяносто две тысячи сто рублей'],
            [21211200, 'RUB', 'двести двенадцать тысяч сто двенадцать рублей'],
            [72001800, 'RUB', 'семьсот двадцать тысяч восемнадцать рублей'],
            [99900000, 'RUB', 'девятьсот девяносто девять тысяч рублей'],
            [99999900, 'RUB', 'девятьсот девяносто девять тысяч девятьсот девяносто девять рублей'],
            [100000000, 'RUB', 'один миллион рублей'],
            [100100100, 'RUB', 'один миллион одна тысяча один рубль'],
            [200000000, 'RUB', 'два миллиона рублей'],
            [324851800, 'RUB', 'три миллиона двести сорок восемь тысяч пятьсот восемнадцать рублей'],
            [400000000, 'RUB', 'четыре миллиона рублей'],
            [500000000, 'RUB', 'пять миллионов рублей'],
            [99900000000, 'RUB', 'девятьсот девяносто девять миллионов рублей'],
            [99900099900, 'RUB', 'девятьсот девяносто девять миллионов девятьсот девяносто девять рублей'],
            [99999900000, 'RUB', 'девятьсот девяносто девять миллионов девятьсот девяносто девять тысяч рублей'],
            [99999999900, 'RUB', 'девятьсот девяносто девять миллионов девятьсот девяносто девять тысяч девятьсот девяносто девять рублей'],
            [117431511000, 'RUB', 'один миллиард сто семьдесят четыре миллиона триста пятнадцать тысяч сто десять рублей'],
            [117431511900, 'RUB', 'один миллиард сто семьдесят четыре миллиона триста пятнадцать тысяч сто девятнадцать рублей'],
            [1517431511000, 'RUB', 'пятнадцать миллиардов сто семьдесят четыре миллиона триста пятнадцать тысяч сто десять рублей'],
            [3517431511900, 'RUB', 'тридцать пять миллиардов сто семьдесят четыре миллиона триста пятнадцать тысяч сто девятнадцать рублей'],
            [93517431511900, 'RUB', 'девятьсот тридцать пять миллиардов сто семьдесят четыре миллиона триста пятнадцать тысяч сто девятнадцать рублей'],
            [293517431511900, 'RUB', 'два триллиона девятьсот тридцать пять миллиардов сто семьдесят четыре миллиона триста пятнадцать тысяч сто девятнадцать рублей'],

            // russian rubles (RUR)
            [-2100, 'RUR', 'минус двадцать один российский рубль'],
            [0, 'RUR', 'ноль российских рублей'],
            [53, 'RUR', 'пятьдесят три копейки'],
            [100, 'RUR', 'один российский рубль'],
            [101, 'RUR', 'один российский рубль одна копейка'],
            [300, 'RUR', 'три российских рубля'],
            [303, 'RUR', 'три российских рубля три копейки'],
            [800, 'RUR', 'восемь российских рублей'],
            [833, 'RUR', 'восемь российских рублей тридцать три копейки'],
            [900, 'RUR', 'девять российских рублей'],
            [999, 'RUR', 'девять российских рублей девяносто девять копеек'],
            [1000, 'RUR', 'десять российских рублей'],
            [1057, 'RUR', 'десять российских рублей пятьдесят семь копеек'],
            [1100, 'RUR', 'одиннадцать российских рублей'],
            [1200, 'RUR', 'двенадцать российских рублей'],
            [1900, 'RUR', 'девятнадцать российских рублей'],
            [2000, 'RUR', 'двадцать российских рублей'],
            [2100, 'RUR', 'двадцать один российский рубль'],
            [2500, 'RUR', 'двадцать пять российских рублей'],
            [5000, 'RUR', 'пятьдесят российских рублей'],
            [5800, 'RUR', 'пятьдесят восемь российских рублей'],
            [9000, 'RUR', 'девяносто российских рублей'],
            [9900, 'RUR', 'девяносто девять российских рублей'],
            [10000, 'RUR', 'сто российских рублей'],
            [10100, 'RUR', 'сто один российский рубль'],
            [10200, 'RUR', 'сто два российских рубля'],
            [11100, 'RUR', 'сто одиннадцать российских рублей'],
            [11300, 'RUR', 'сто тринадцать российских рублей'],
            [12000, 'RUR', 'сто двадцать российских рублей'],
            [12100, 'RUR', 'сто двадцать один российский рубль'],
            [22900, 'RUR', 'двести двадцать девять российских рублей'],
            [50000, 'RUR', 'пятьсот российских рублей'],
            [66000, 'RUR', 'шестьсот шестьдесят российских рублей'],
            [66600, 'RUR', 'шестьсот шестьдесят шесть российских рублей'],
            [90000, 'RUR', 'девятьсот российских рублей'],
            [90900, 'RUR', 'девятьсот девять российских рублей'],
            [91900, 'RUR', 'девятьсот девятнадцать российских рублей'],
            [99000, 'RUR', 'девятьсот девяносто российских рублей'],
            [99900, 'RUR', 'девятьсот девяносто девять российских рублей'],
            [100000, 'RUR', 'одна тысяча российских рублей'],
            [100100, 'RUR', 'одна тысяча один российский рубль'],
            [101000, 'RUR', 'одна тысяча десять российских рублей'],
            [101500, 'RUR', 'одна тысяча пятнадцать российских рублей'],
            [110000, 'RUR', 'одна тысяча сто российских рублей'],
            [111100, 'RUR', 'одна тысяча сто одиннадцать российских рублей'],
            [200000, 'RUR', 'две тысячи российских рублей'],
            [400000, 'RUR', 'четыре тысячи российских рублей'],
            [453800, 'RUR', 'четыре тысячи пятьсот тридцать восемь российских рублей'],
            [500000, 'RUR', 'пять тысяч российских рублей'],
            [502000, 'RUR', 'пять тысяч двадцать российских рублей'],
            [770000, 'RUR', 'семь тысяч семьсот российских рублей'],
            [1100000, 'RUR', 'одиннадцать тысяч российских рублей'],
            [1100100, 'RUR', 'одиннадцать тысяч один российский рубль'],
            [2100000, 'RUR', 'двадцать одна тысяча российских рублей'],
            [2151200, 'RUR', 'двадцать одна тысяча пятьсот двенадцать российских рублей'],
            [9000000, 'RUR', 'девяносто тысяч российских рублей'],
            [9210000, 'RUR', 'девяносто две тысячи сто российских рублей'],
            [21211200, 'RUR', 'двести двенадцать тысяч сто двенадцать российских рублей'],
            [72001800, 'RUR', 'семьсот двадцать тысяч восемнадцать российских рублей'],
            [99900000, 'RUR', 'девятьсот девяносто девять тысяч российских рублей'],
            [99999900, 'RUR', 'девятьсот девяносто девять тысяч девятьсот девяносто девять российских рублей'],
            [100000000, 'RUR', 'один миллион российских рублей'],
            [100100100, 'RUR', 'один миллион одна тысяча один российский рубль'],
            [200000000, 'RUR', 'два миллиона российских рублей'],
            [324851800, 'RUR', 'три миллиона двести сорок восемь тысяч пятьсот восемнадцать российских рублей'],
            [400000000, 'RUR', 'четыре миллиона российских рублей'],
            [500000000, 'RUR', 'пять миллионов российских рублей'],
            [99900000000, 'RUR', 'девятьсот девяносто девять миллионов российских рублей'],
            [99900099900, 'RUR', 'девятьсот девяносто девять миллионов девятьсот девяносто девять российских рублей'],
            [99999900000, 'RUR', 'девятьсот девяносто девять миллионов девятьсот девяносто девять тысяч российских рублей'],
            [99999999900, 'RUR', 'девятьсот девяносто девять миллионов девятьсот девяносто девять тысяч девятьсот девяносто девять российских рублей'],
            [117431511000, 'RUR', 'один миллиард сто семьдесят четыре миллиона триста пятнадцать тысяч сто десять российских рублей'],
            [117431511900, 'RUR', 'один миллиард сто семьдесят четыре миллиона триста пятнадцать тысяч сто девятнадцать российских рублей'],
            [1517431511000, 'RUR', 'пятнадцать миллиардов сто семьдесят четыре миллиона триста пятнадцать тысяч сто десять российских рублей'],
            [3517431511900, 'RUR', 'тридцать пять миллиардов сто семьдесят четыре миллиона триста пятнадцать тысяч сто девятнадцать российских рублей'],
            [93517431511900, 'RUR', 'девятьсот тридцать пять миллиардов сто семьдесят четыре миллиона триста пятнадцать тысяч сто девятнадцать российских рублей'],
            [293517431511900, 'RUR', 'два триллиона девятьсот тридцать пять миллиардов сто семьдесят четыре миллиона триста пятнадцать тысяч сто девятнадцать российских рублей'],

            [100, 'TRY', 'одна турецкая лира'],
            [200, 'TRY', 'две турецкие лиры'],
            [500, 'TRY', 'пять турецких лир'],
            [34000, 'TRY', 'триста сорок турецких лир'],
            [34100, 'TRY', 'триста сорок одна турецкая лира'],
            [34200, 'TRY', 'триста сорок две турецкие лиры'],
            [34400, 'TRY', 'триста сорок четыре турецкие лиры'],
            [34500, 'TRY', 'триста сорок пять турецких лир'],
            [34552, 'TRY', 'триста сорок пять турецких лир пятьдесят два куруша'],
            [34501, 'TRY', 'триста сорок пять турецких лир один куруш'],
            [34599, 'TRY', 'триста сорок пять турецких лир девяносто девять курушей'],

            [100, 'SGD', 'один сингапурский доллар'],
            [200, 'SGD', 'два сингапурских доллара'],
            [500, 'SGD', 'пять сингапурских долларов'],
            [34000, 'SGD', 'триста сорок сингапурских долларов'],
            [34100, 'SGD', 'триста сорок один сингапурский доллар'],
            [34200, 'SGD', 'триста сорок два сингапурских доллара'],
            [34400, 'SGD', 'триста сорок четыре сингапурских доллара'],
            [34500, 'SGD', 'триста сорок пять сингапурских долларов'],
            [34552, 'SGD', 'триста сорок пять сингапурских долларов пятьдесят два цента'],
            [34501, 'SGD', 'триста сорок пять сингапурских долларов один цент'],
            [34599, 'SGD', 'триста сорок пять сингапурских долларов девяносто девять центов'],

            [100, 'NZD', 'один новозеландский доллар'],
            [200, 'NZD', 'два новозеландских доллара'],
            [500, 'NZD', 'пять новозеландских долларов'],
            [34000, 'NZD', 'триста сорок новозеландских долларов'],
            [34100, 'NZD', 'триста сорок один новозеландский доллар'],
            [34200, 'NZD', 'триста сорок два новозеландских доллара'],
            [34400, 'NZD', 'триста сорок четыре новозеландских доллара'],
            [34500, 'NZD', 'триста сорок пять новозеландских долларов'],
            [34552, 'NZD', 'триста сорок пять новозеландских долларов пятьдесят два цента'],
            [34501, 'NZD', 'триста сорок пять новозеландских долларов один цент'],
            [34599, 'NZD', 'триста сорок пять новозеландских долларов девяносто девять центов'],

            [100, 'MDL', 'один молдавский лей'],
            [200, 'MDL', 'два молдавских лея'],
            [500, 'MDL', 'пять молдавских леев'],
            [34000, 'MDL', 'триста сорок молдавских леев'],
            [34100, 'MDL', 'триста сорок один молдавский лей'],
            [34200, 'MDL', 'триста сорок два молдавских лея'],
            [34400, 'MDL', 'триста сорок четыре молдавских лея'],
            [34500, 'MDL', 'триста сорок пять молдавских леев'],
            [34552, 'MDL', 'триста сорок пять молдавских леев пятьдесят два баня'],
            [34501, 'MDL', 'триста сорок пять молдавских леев один бань'],
            [34599, 'MDL', 'триста сорок пять молдавских леев девяносто девять баней'],


            [100, 'CNY', 'один китайский юань'],
            [200, 'CNY', 'два китайских юаня'],
            [300, 'CNY', 'три китайских юаня'],
            [500, 'CNY', 'пять китайских юаней'],
            [34000, 'CNY', 'триста сорок китайских юаней'],
            [34100, 'CNY', 'триста сорок один китайский юань'],
            [34200, 'CNY', 'триста сорок два китайских юаня'],
            [34400, 'CNY', 'триста сорок четыре китайских юаня'],
            [34500, 'CNY', 'триста сорок пять китайских юаней'],
            [34552, 'CNY', 'триста сорок пять китайских юаней пятьдесят два фыня'],
            [34501, 'CNY', 'триста сорок пять китайских юаней один фынь'],
            [34599, 'CNY', 'триста сорок пять китайских юаней девяносто девять фыней'],

            [100, 'SGD', 'один сингапурский доллар'],
            [200, 'SGD', 'два сингапурских доллара'],
            [300, 'SGD', 'три сингапурских доллара'],
            [500, 'SGD', 'пять сингапурских долларов'],
            [34000, 'SGD', 'триста сорок сингапурских долларов'],
            [34100, 'SGD', 'триста сорок один сингапурский доллар'],
            [34200, 'SGD', 'триста сорок два сингапурских доллара'],
            [34400, 'SGD', 'триста сорок четыре сингапурских доллара'],
            [34500, 'SGD', 'триста сорок пять сингапурских долларов'],
            [34552, 'SGD', 'триста сорок пять сингапурских долларов пятьдесят два цента'],
            [34501, 'SGD', 'триста сорок пять сингапурских долларов один цент'],
            [34599, 'SGD', 'триста сорок пять сингапурских долларов девяносто девять центов'],

            [100, 'UZS', 'один сум'],
            [200, 'UZS', 'два сума'],
            [300, 'UZS', 'три сума'],
            [500, 'UZS', 'пять сумов'],
            [34000, 'UZS', 'триста сорок сумов'],
            [34100, 'UZS', 'триста сорок один сум'],
            [34200, 'UZS', 'триста сорок два сума'],
            [34400, 'UZS', 'триста сорок четыре сума'],
            [34500, 'UZS', 'триста сорок пять сумов'],
            [34552, 'UZS', 'триста сорок пять сумов пятьдесят два тийина'],
            [34501, 'UZS', 'триста сорок пять сумов один тийин'],
            [34599, 'UZS', 'триста сорок пять сумов девяносто девять тийинов'],
        ];
    }
}

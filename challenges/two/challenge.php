<?php
//10: Допустим, доступ к сайту разрешен только диапазопу ip адресов.
//Есть диапазон IP 49.5.0.0/20, надо сравнить пользовательский IP 49.5.100.152 с данным диапазоном.
//Вывести сообщение, что пользователь не имеет доступа, если ip не входит в заданный диапазон, или сообщение о том, что
//ему разрешен доступ, если результат обратный.

//вариант простой: считаем диапазон калькулятором
$hostmin = '49.5.0.1';
$hostmax = '49.5.15.254';


$ip_input = '49.5.100.152';
//сделаем из всех айпишников массивы для удобного сравнения
$hostmin = explode('.', $hostmin);
$hostmax = explode('.', $hostmax);
$ip = explode('.', $ip_input);


for ($i = 0; $i <= count($ip); $i++) {
    if ($ip[$i] >= $hostmin[$i] && $ip[$i] <= $hostmax[$i]) {
        $result = '<span style="color:green">Your IP ' . $ip_input . ' isn`t banned</span>';
    } else {
        $result = '<span style="color:red">Your IP ' . $ip_input . ' is banned</span>';
        break;
    }
}

//echo $result;


//вариант сложнее: используем функции php для проверки
$ip_array = '49.5.0.0/20'; //входящий диапазон
$ip_input = '49.5.100.152'; //проверяемый IP

//слямзенная функция проверки входит ли искомый ip в заданный диапазон
function ipCIDRcheck($ip, $cidr)
{
    list($net, $mask) = explode('/', $cidr);
    return (ip2long($ip) & (-1 << (32 - $mask))) == ip2long($net);
}

if ((ipCIDRcheck($ip_input, $ip_array)) == true) {
    $result = '<span style="color:green">Your IP ' . $ip_input . ' isn`t banned</span>';
} else {
    $result = '<span style="color:red">Your IP ' . $ip_input . ' is banned</span>';
}

echo $result;
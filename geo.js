if (typeof navigator.geolocation == 'undefined')
    alert("Геолокация не поддерживается.") 
    else
    navigator.geolocation.getCurrentPosition(granted, denied) 
    function granted(position)
    {
    var lat = position.coords.latitude
    var lon = position.coords.longitude
    alert("Разрешение дано. Ваше местонахождение:\n\n"
    + lat + ", " + lon)
    }

function denied(error)
{
    var message
    switch(error.code)
    {
    case 1: message = 'Доступ запрещен'; break;
    case 2: message = 'Позиция недоступна'; break;
    case 3: message = 'Время ожидания операции истекло'; break;
    case 4: message = 'Неизвестная ошибка'; break;
    }
    alert("Ошибка геолокации: " + message)
}
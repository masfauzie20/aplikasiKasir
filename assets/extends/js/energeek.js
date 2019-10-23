var preventLeaving = function () {        
	window.onbeforeunload = function() {
		return "Are you sure you want to navigate away?";
	}
}

var helpCurrency = function(value='', logo_currency='', pemisah='.', pemisah_sen=',', end='00') {
	value = String(value);
	if(value == '' || value == 'null'){
		value = '0';
	}

    var split_value = value.split(".");

    if(end != ''){
    	end = pemisah_sen+end;
    }

    if(split_value.length > 1){
    	if(split_value[1].length == 1){
    		end = pemisah_sen+split_value[1]+'0';
    	}else{
    		end = pemisah_sen+split_value[1];
    	}
    }

    return logo_currency + split_value[0].split("").reverse().reduce(function(acc, value, i, orig) {
        return  value=="-" ? acc : value + (i && !(i % 3) ? pemisah : "") + acc;
    }, "") + end;

}

var reformat_number = function (value="") {
	if(value == ""){
		return 0;
	}else{
		return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
	}
}

var protectNumber = function(target="", maxLength="") {
	$(target).keyup(function(event){
		var replaced_value = '';
		/* skip for arrow keys */
		if(event.which >= 37 && event.which <= 40) return;

		/* format number */
		$(this).val(function(index, value) {
			replaced_value = value.replace(/\D/g, "");

			if(maxLength != '' && !isNaN(maxLength)){
				replaced_value = replaced_value.substr(0, maxLength);
			}

			return replaced_value;
		});
	});
}

var protectString = function(target="", maxStringLength='') {
	$(target).keyup(function(event){
		var pattern = /[^a-zA-Z0-9-., ]/g;
		var replaced_value = '';

		/* format number */
		$(this).val(function(index, value) {
			replaced_value = value.replace(pattern, '');
			if(maxStringLength != '' && !isNaN(maxStringLength)){
				replaced_value = replaced_value.substr(0, maxStringLength);
			}
			return replaced_value;
			;
		});
	});
}

var helpDay = function(value, mode='id', category='full')
{
	var dayArray = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
	if(category != 'full'){
		dayArray = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
	}

	if(mode == 'eng'){
		dayArray = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
		if(category != 'full'){
			dayArray = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		}
	}

	if(dayArray[value]){
		return dayArray[value];
	}else{
		return 'Undefined';
	}
}

/**
* Function helpMonth
* Fungsi ini digunakan untuk mencari nama bulan dalam bahasa Indonesia
* @access public
* @param (int) var Nomor urut bulan yang dimulai dari angka 0 untuk bulan januari
* @return (string) {'Undefined'}
*/
var helpMonth = function (num, mode='id', category='full')
{
	var monthArray = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

	if(category != 'full'){
		monthArray = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
	}

	if(mode == 'eng'){
		monthArray = ["January", "February", "March", "April", "May", "June", "Jule", "August", "September", "October", "November", "December"];
		if(category != 'full'){
			monthArray = ["Jan", "Feb", "Mar", "Apr", "May", "June", "Jule", "August", "September", "October", "November", "December"];
		}
	}

	if(monthArray[num]){
		return monthArray[num];
	}else{
		return 'Undefined';
	}
}

/**
* Function helpDateFormat
* Fungsi ini digunakan untuk melakukan konversi format tanggal
* @access public
* @param (date) var Tanggal yang akan dikonversi
* @param (string) mode Kode untuk model format yang baru
- se (short English)		: (Y-m-d) 2015-31-01
- si (short Indonesia)	: (d-m-Y) 31-01-2015
- me (medium English)	: (F d, Y) January 31, 2015
- mi (medium Indonesia)	: (d F Y) 31 Januari 2015
- le (long English)		: (l F d, Y) Sunday January 31, 2015
- li (long Indonesia)	: (l, d F Y) Senin, 31 Januari 2015
* @return (string) {'Undefined'}
*/
var helpDateFormat = function (value, mode = 'se')
{
	var help_date = new Date(value);
	var date = help_date.getDate(),
	month = help_date.getMonth(),
	year = help_date.getFullYear(),
	day = help_date.getDay(),
	text_month = (month + 1);
	
	if(date < 10){
		date = '0'+date;
	}

	if(text_month < 10){
		text_month = '0'+text_month;
	}

	switch(mode){
		case 'se':
		return year+'-'+text_month+'-'+date;
		break;
		case 'si':
		return date+'-'+text_month+'-'+year;
		break;
		case 'me':
		return helpMonth(month, 'eng')+' '+date+', '+year;
		break;
		case 'mi':
		return date+' '+helpMonth(month)+' '+year;
		break;
		case 'le':
		return helpDay(day, 'eng')+' '+helpMonth(month, 'eng')+' '+date+', '+year;
		break;
		case 'li':
		return helpDay(day)+', '+date+' '+helpMonth(month)+' '+year;
		break;
		case 'bi':
		return helpMonth(month)+' '+year;
		break;
		default:
		return 'Undefined';
		break;
	}
}

var helpTime = function (value, category=24, mode='2', separator='.') {
	var help_time = new Date(value);
	var hours = help_time.getHours(),
	minutes = help_time.getMinutes(),
	milliseconds = help_time.getMilliseconds(),
	end = '';

	if(minutes < 10){
		minutes = '0'+minutes;
	}

	if(milliseconds < 10){
		milliseconds = '0'+milliseconds;
	}

	if(category == 12){
		if(hours > 11){
			end = ' PM';
		}else{
			end = ' AM';
		}

		if(hours > 12){
			hours = (hours - 12);
		}
	}

	switch (mode){
		case '3' :
		return hours+separator+minutes+separator+milliseconds+end;
		break;
		default: 
		return hours+separator+minutes+end;
		break;
	}
}

var formatBytes = function(bytes,decimals) {
   if(bytes == 0) return '0 Bytes';
   var k = 1024,
       dm = decimals <= 0 ? 0 : decimals || 2,
       sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
       i = Math.floor(Math.log(bytes) / Math.log(k));
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
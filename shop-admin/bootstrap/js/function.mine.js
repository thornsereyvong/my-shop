function checkDate(date){
	if(date != ''){
		var dtRegex = new RegExp(/\b\d{1,2}[\/-]\w{1,3}[\/-]\d{4}\b/);
		return dtRegex.test(date);
	}
	return false;
}
function checkMonthAndYear(date){
	if(date != ''){
		var dtRegex = new RegExp(/\b\w{1,3}[\/-]\d{4}\b/);
		return dtRegex.test(date);
	}
	return false;
}
function getLastDayOfMonth(){
	 var t= new Date();
    return new Date(t.getFullYear(), t.getMonth() + 1, 0, 23, 59, 59).getDate();
}
function formatNum(n) {
    return Number(n).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
function formatNumAcc(n) {
	if(Number(n)<0)
		return '('+(Number(n)*(-1)).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")+')';
	return Number(n).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
function formatNumAccRe(n,R) {
	if((Number(n)*R)<0)
		return '('+(Number(n)*(-1)*R).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")+')';
	return (Number(n)*R).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
function loadingImg(id,Class){
	$("#"+id).find("i").removeClass(Class);
	$("#"+id).find("i").append("<img src='img/loading.gif' width='25'/>");
	$("#"+id).prop('disabled', true);
}
function unloadingImg(id,Class){
	$("#"+id).find("i").addClass(Class);
	$("#"+id).find("i").find("img").remove();
	$("#"+id).prop('disabled', false);
}
function checkError(fields){
	for(i=0;i<fields.length;i++){
		var check = $("#"+fields[i]).parent().attr("class").split(' ');
		if(check[check.length-1]=="has-error"){
			return false;
		}
	}
	return true;
}

function dis(data){
	$("#errors").append(JSON.stringify(data));
}
function dis1(data){
	$("#errors").append(data);
}

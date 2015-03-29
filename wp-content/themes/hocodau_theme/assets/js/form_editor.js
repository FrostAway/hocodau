var ifr;
function iFrameOn() {
    ifr = document.getElementById('ifr_content').contentWindow.document;
    ifr.designMode = "On";
}
function iBold() {
    ifr.execCommand('bold', false, null);
}
function iItalic() {
    ifr.execCommand('italic', false, null);
}
function iUnderline() {
    ifr.execCommand('underline', false, null);
}
function iFontSize(){
    size = $('#editor_bar .ifontsize').val();
    ifr.execCommand('FontSize', false, size);
}
function colorPicker(){
    $('.color-picker').fadeIn(300);
}
function setColor(color){
    ifr.execCommand('forecolor', false, color);
    $('.table-color td').removeClass('pick');
    $('td[bgcolor='+color+']').addClass('pick');
    $('.ifontcolor').css('background', color);
    $('.color-picker').fadeOut(300);
}
function colorClose(){
    $('.color-picker').fadeOut(300);
}

function iLink(){
    link = prompt('Enter a link: ', 'http://');
    ifr.execCommand('CreateLink', false, link);
}
function iUnlink(){
    ifr.execCommand('UnLink', false, null);
}
function iImage(){
    var src = prompt('Enter Location: ', '');
    if(src !== null){
        ifr.execCommand('insertimage', false, src);
    }
}

function iOrderedList(){
    ifr.execCommand('insertorderedlist', false, null);
}
function iUnOrderedList(){
    ifr.execCommand('insertunorderedlist', false, null);
}
function iCenter(){
    ifr.execCommand('justifycenter', false, null);
}
function iJustify(){
    ifr.execCommand('justifyfull', false, null);
}
function iLeft(){
    ifr.execCommand('justifyleft', false, null);
}
function iRight(){
    ifr.execCommand('justifyright', false, null);
}

function submit_form() {
    var theForm = document.getElementById('myform');
    theForm.elements['area-content'].value = window.frames['ifr_content'].document.body.innerHTML;
    theForm.submit();
}



var tabCharacter = "  ";
var tabOffset = 2;

$(document).on('click', '#indent', function(e){
	e.preventDefault();
	var self = $(this);
	
	self.toggleClass('active');
	
	if(self.hasClass('active'))
	{
		tabCharacter = "\\t";
		tabOffset = 1;
	}
	else
	{
		tabCharacter = "  ";
		tabOffset = 2;
	}
})

$(document).on('click', '#fullscreen', function(e){
	e.preventDefault();
	var self = $(this);
	
	self.toggleClass('active');
	self.parents('.editor-holder').toggleClass('fullscreen');
});

/*------------------------------------------
	Render existing code
------------------------------------------*/
$(document).on('ready', function(){
	hightlightSyntax();
	
	emmet.require('textarea').setup({
    pretty_break: true,
    use_tab: true
	});
});




/*------------------------------------------
	Capture text updates
------------------------------------------*/
$(document).on('ready load keyup keydown change', '.editor', function(){
	correctTextareaHight(this);
	hightlightSyntax();
});


/*------------------------------------------
	Resize textarea based on content  
------------------------------------------*/
function correctTextareaHight(element)
{
  var self = $(element),
      outerHeight = self.outerHeight(),
      innerHeight = self.prop('scrollHeight'),
      borderTop = parseFloat(self.css("borderTopWidth")),
      borderBottom = parseFloat(self.css("borderBottomWidth")),
      combinedScrollHeight = innerHeight + borderTop + borderBottom;
  
  if(outerHeight < combinedScrollHeight )
  {
    self.height(combinedScrollHeight);
  }
}
// function correctTextareaHight(element){
// 	while($(element).outerHeight() < element.scrollHeight + parseFloat($(element).css("borderTopWidth")) + parseFloat($(element).css("borderBottomWidth"))) {
// 		$(element).height($(element).height()+1);
// 	};
// }


/*------------------------------------------
	Run syntax hightlighter  
------------------------------------------*/
function hightlightSyntax(){
	var me  = $('.editor');
	var content = me.val();
	var codeHolder = $('code');
	var escaped = escapeHtml(content);
	
	codeHolder.html(escaped);
	
	$('.syntax-highight').each(function(i, block) {
		hljs.highlightBlock(block);
	});
}


/*------------------------------------------
	String html characters
------------------------------------------*/
function escapeHtml(unsafe) {
	return unsafe
			 .replace(/&/g, "&amp;")
			 .replace(/</g, "&lt;")
			 .replace(/>/g, "&gt;")
			 .replace(/"/g, "&quot;")
			 .replace(/'/g, "&#039;");
}


/*------------------------------------------
	Enable tabs in textarea
------------------------------------------*/
$(document).delegate('.allow-tabs', 'keydown', function(e) {
	var keyCode = e.keyCode || e.which;

	if (keyCode == 9) {
		e.preventDefault();
		var start = $(this).get(0).selectionStart;
		var end = $(this).get(0).selectionEnd;

		// set textarea value to: text before caret + tab + text after caret
		$(this).val($(this).val().substring(0, start)
								+ tabCharacter
								+ $(this).val().substring(end));

		// put caret at right position again
		$(this).get(0).selectionStart =
		$(this).get(0).selectionEnd = start + tabOffset;
	}
});

function changeTextColor(value) {
    // Get the textarea element
    var textarea = document.getElementById('myTextarea');

    // Set the text color based on the input value
    // For example, change text color to red if input contains 'red'
    if (value.toLowerCase().includes('red')) {
        textarea.style.color = 'red';
    } else {
        textarea.style.color = 'black';
    }
}
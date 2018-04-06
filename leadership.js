$(document).ready(function(){
	var moreText = "Read More",
    lessText = "Read Less",
    moreButton = $("a.readmorebtn");
    console.log(moreButton.text());
	moreButton.click(function () {
    	var $this = $(this);
    	$this.text($this.text() == moreText ? lessText : moreText).next("p.more").slideToggle("fast");
	});
});

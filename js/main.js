// 모든문서가 로딩이 되면 자동으로 실행해준는 함수
$(function() {
  // 사용될 변수선언
  var slideshow = $('.slideshow'),
    slideshowSlides = slideshow.find('.slideshow_slides'),
    slides = slideshowSlides.find('a'),
    slidesCount = slides.length,
    nav = slideshow.find('.slideshow_nav'),
    prev = nav.find('.prev'),
    next = nav.find('.next'),
    currentIndex = 0, //현재슬라이드를 첫번째 화면 셋팅
    interval = 1500, //자동슬라이드 변화 시간
    timer = null,
    incrementValue = 1,
    indicator = slideshow.find('.slideshow_indicator');
  //이벤트처리 슬라이드를 배치시킨다. 가로로 배치시킨다
  //슬0 왼쪽 0%, 슬1 100%, 슬2 200%, 슬3 300%
  slides.each(function(i) {
    var newLeft = (i * 100) + '%';
    $(this).css({
      left: newLeft
    });
  });

  //슬라이드 화면이동하는 함수를 생성한다.
  function gotoSlide(index) {
    slideshowSlides.animate({
      left: (-100 * index) + '%'
    }, 1000, 'easeInOutExpo');
    currentIndex = index;
    if (currentIndex == 0) {
      prev.addClass('disabled');
    } else {
      prev.removeClass('disabled');
    }

    if (currentIndex == (slidesCount - 1)) {
      next.addClass('disabled');
    } else {
      next.removeClass('disabled');
    }

    indicator.find('a').removeClass('active');
    indicator.find('a').eq(currentIndex).addClass('active');
  }

  //이벤트처리 네비게이션 처리진행
  prev.click(function(event) {
    event.preventDefault(); //a tag에서 기본기능막기
    if (currentIndex !== 0) {
      currentIndex -= 1;
    }
    gotoSlide(currentIndex);
  });

  next.click(function(event) {
    event.preventDefault(); //a tag에서 기본기능막기
    if (currentIndex !== (slidesCount - 1)) {
      currentIndex += 1;
    }
    gotoSlide(currentIndex);
  });

  indicator.find('a').click(function(event) {
    event.preventDefault();
    var point = $(this).index();
    gotoSlide(point);
  });

  //자동슬라이드 함수
  function autoDisplayStart() {
    timer = setInterval(function() {
      if (currentIndex === 5) {
        incrementValue = -1;
      } else if (currentIndex === 0) {
        incrementValue = 1;
      }
      var nextIndex = (currentIndex + incrementValue) % slidesCount;
      gotoSlide(nextIndex);
    }, interval);
  }

  function autoDisplayStop() {
    clearInterval(timer);
  }

  slideshow.mouseenter(function(event) {
    autoDisplayStop();
  });

  slideshow.mouseleave(function(event) {
    autoDisplayStart();
  });

  autoDisplayStart();
  //gotoSlide(currentIndex);


});

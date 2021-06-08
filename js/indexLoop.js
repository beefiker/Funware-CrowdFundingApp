
    
const mQuery = window.matchMedia('(max-width: 375px)');



window.onload=function() {
    if (window.matchMedia('(max-width: 375px)').matches) {     
        // Then log the following message to the console     
        console.log('Media Query Matched!') 
        notmobile = document.querySelector('#new-cards');
        notmobile1 = document.querySelector('#recommend-cards');
        notmobile.classList.add('animated');
        notmobile1.classList.add('animated');
        careselWidth = 375;
        ojs();  
   

    }else if(window.matchMedia('(max-width: 768px)').matches){
        careselWidth = 718;
   }else{
       notmobile = document.querySelector('#new-cards');
       notmobile.style.width = 100 +'%';
       notmobile.style.left = 0;
       notmobile.style.transform = '';

       notmobile1 = document.querySelector('#recommend-cards');
       notmobile1.style.width = 100 +'%';
       notmobile1.style.left = 0;
       notmobile1.style.transform = '';
       $('.clone').remove();
   }
    
}



function handleMobilePhoneResize(e) {   
   // Check if the media query is true
   if (e.matches) {     
        // Then log the following message to the console     
        console.log('Media Query Matched!') 
        notmobile = document.querySelector('#new-cards');
        notmobile1 = document.querySelector('#recommend-cards');
        notmobile.classList.add('animated');
        notmobile1.classList.add('animated');
        ojs();  
   }else{
       notmobile = document.querySelector('#new-cards');
       notmobile.style.width = 100 +'%';
       notmobile.style.left = 0;
       notmobile.style.transform = '';

       notmobile1 = document.querySelector('#recommend-cards');
       notmobile1.style.width = 100 +'%';
       notmobile1.style.left = 0;
       notmobile1.style.transform = '';
       $('.clone').remove();
   }    
} 



// Set up event listener 
mQuery.addListener(handleMobilePhoneResize);

function makeClone() {
    if(slideCount > 2) {
        clone1 = document.querySelectorAll('.wrapNewCard');
        for (var i = 0; i < slideCount; i++) {
            var cloneSlide = slide[i].cloneNode(true);
            cloneSlide.classList.add('clone');
            slides.appendChild(cloneSlide);
            clone1[i].style.display = "block";
        }
        for (var i = slideCount - 1; i >= 0; i--) {
            var cloneSlide = slide[i].cloneNode(true);
            cloneSlide.classList.add('clone');
            slides.prepend(cloneSlide);
            clone1[i].style.display = "block";
        }
        updateWidth();
        setInitialPos();
    
    }else{
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
    }
}

function updateWidth() {
    var currentSlides = document.querySelectorAll('#recommend-cards div');
    var newSlideCount = currentSlides.length;
    var newWidth = (slideWidth + slideMargin) * newSlideCount + 'px';
    slides.style.width = newWidth;
}

function setInitialPos() {
    var initialTranslateValue = -(slideWidth + slideMargin) * slideCount;
    slides.style.transform = 'translateX(' + initialTranslateValue + 'px)';
}

//.....

function makeClone1() {
    if(slideCount1 > 2) {
        clone = document.querySelectorAll('.wrapRecomCard');
        for (var i = 0; i < slideCount1; i++) {
            var cloneSlide1 = slide1[i].cloneNode(true);
            cloneSlide1.classList.add('clone');
            slides1.appendChild(cloneSlide1);
            clone[i].style.display = "block";
        }
        for (var i = slideCount1 - 1; i >= 0; i--) {
            var cloneSlide1 = slide1[i].cloneNode(true);
            cloneSlide1.classList.add('clone');
            slides1.prepend(cloneSlide1);
            clone[i].style.display = "block";
        }
        updateWidth1();
        setInitialPos1();
       
    }else{
        prevBtn1.style.display = 'none';
        nextBtn1.style.display = 'none';
    }
}

function updateWidth1() {
    var currentSlides1 = document.querySelectorAll('#recommend-cards div');
    var newSlideCount1 = currentSlides1.length;
    var newWidth1 = (slideWidth1 + slideMargin1) * newSlideCount1 + 'px';
    slides1.style.width = newWidth1;
}

function setInitialPos1() {
    var initialTranslateValue1 = -(slideWidth1 + slideMargin1) * slideCount1;
    slides1.style.transform = 'translateX(' + initialTranslateValue1 + 'px)';
}




function ojs(){ 
    slides = document.querySelector('#new-cards'),
    slide = document.querySelectorAll('#new-cards>.wrapNewCard'),
    currentIdx = 0,
    slideCount = slide.length,
    slideWidth = 98,
    slideMargin = 20;
    let prevBtn = document.querySelector('#movieList_slideLeft_new');
    let nextBtn = document.querySelector('#movieList_slideRight_new');




    slides1 = document.querySelector('#recommend-cards'),
    slide1 = document.querySelectorAll('#recommend-cards>.wrapRecomCard'),
    currentIdx1 = 0,
    slideCount1 = slide1.length,
    slideWidth1 = 98,
    slideMargin1 = 20;
    let prevBtn1 = document.querySelector('#movieList_slideLeft_recom');
    let nextBtn1 = document.querySelector('#movieList_slideRight_recom');

    makeClone1();
    makeClone();
    if (window.ojs_makeClone == undefined) {
        window.ojs_makeClone = true;
    } else {
        return;
    }
   
    nextBtn.addEventListener('click', function () {
        moveSlide(currentIdx + 1);
    })

    prevBtn.addEventListener('click', function () {
        moveSlide(currentIdx - 1);
    })

    function moveSlide(num) {
        slides.style.left = -num * (slideWidth + slideMargin) + 'px';
        currentIdx = num;
        console.log(num);
        if (currentIdx == slideCount || currentIdx == -slideCount) {
            setTimeout(function () {
                slides.classList.remove('animated');
                slides.style.left = '0px';
                currentIdx = 0;
            }, 500);

            setTimeout(function () {
                slides.classList.add('animated');
            }, 550);
        }
    }

    /*후원*/

    nextBtn1.addEventListener('click', function () {
    moveSlide1(currentIdx1 + 1);
    })

    prevBtn1.addEventListener('click', function () {
    moveSlide1(currentIdx1 - 1);
    })

    function moveSlide1(num) {
        slides1.style.left = -num * (slideWidth1 + slideMargin1) + 'px';
        currentIdx1 = num;
        if (currentIdx1 == slideCount1 || currentIdx1 == -slideCount1) {
            setTimeout(function () {
                slides1.classList.remove('animated');
                slides1.style.left = '0px';
                currentIdx1 = 0;
            }, 500);

            setTimeout(function () {
                slides1.classList.add('animated');
            }, 550);
        }
    }

    /*투자*/


  
    /*북마크*/

        
};

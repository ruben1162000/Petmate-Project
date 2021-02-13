var body = document.getElementsByTagName('body')[0],
    images=['/imgs/cat.jpeg','/imgs/mouse.jpg','/imgs/rabbit.jpg','/imgs/dog2.jpeg','/imgs/dog.jpg','/imgs/catdog.jpg','/imgs/dogs.jpg'],
    num=images.length-1,
    i=0;

    setInterval(function(){
        body.style.backgroundImage="url("+images[i]+")";
        if(i==num){
            i=0;
        }else{
            i++;
        }
    },4000);

    $('#slideit').on('click',function(){
        let x = $('ul:nth-of-type(3)');
        x.slideToggle(800,function(){/*do nothing on call back}*/});
    });

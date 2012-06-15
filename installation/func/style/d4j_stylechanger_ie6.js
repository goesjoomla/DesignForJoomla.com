function changeContainerWidth(newWidth) {
        var obj1 = document.getElementById('container');
        var obj2 = document.getElementById('box2')
        var obj3 = document.getElementById('box3')
        currentContainerWidth = parseInt(newWidth);
        if (currentContainerWidth == 0)
        {obj1.style.width = '96%';
        obj2.style.width = '100%';
        obj3.style.width = '100%';}
        else {obj1.style.width = currentContainerWidth + 'px';
              obj2.style.width = (currentContainerWidth-14) + 'px';
        }
};
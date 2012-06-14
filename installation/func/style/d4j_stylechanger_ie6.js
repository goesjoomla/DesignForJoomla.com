function changeContainerWidth(newWidth) {
        var obj1 = document.getElementById('container');
        var obj2 = document.getElementById('rbox')
        currentContainerWidth = parseInt(newWidth);
        if (currentContainerWidth == 0)
        {obj1.style.width = '96%';
        obj2.style.width = '60.59%';}
        else {obj1.style.width = currentContainerWidth + 'px';
              obj2.style.width = (currentContainerWidth-380) + 'px';
        }
};

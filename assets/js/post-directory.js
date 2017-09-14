/**
 * Post Directory for TypeNow.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

(function( $ ) {

    // Create Post Directory.
    var postDirectoryBuild = function() {
        var postChildren = function children(childNodes, reg) {
            var result = [],
                isReg = typeof reg === 'object',
                isStr = typeof reg === 'string',
                node, i, len;
            for (i = 0, len = childNodes.length; i < len; i++) {
                node = childNodes[i];
                if ((node.nodeType === 1 || node.nodeType === 9) &&
                    (!reg || isReg && reg.test(node.tagName.toLowerCase()) || isStr && node.tagName.toLowerCase() === reg)) {
                    result.push(node);
                }
            }
            return result;
        },
        createPostDirectory = function(article, directory, isDirNum) {
            var contentArr = [],
                titleId = [],
                levelArr, root, level,
                currentList, list, li, link, i, len;
            levelArr = (function(article, contentArr, titleId) {
                var titleElem = postChildren(article.childNodes, /^h\d$/),
                    levelArr = [],
                    lastNum = 1,
                    lastRevNum = 1,
                    count = 0,
                    guid = 1,
                    id = 'post-dir-',
                    lastRevNum, num, elem;
                while (titleElem.length) {
                    elem = titleElem.shift();
                    contentArr.push(elem.innerHTML);
                    num = +elem.tagName.match(/\d/)[0];
                    if (num > lastNum) {
                        levelArr.push(1);
                        lastRevNum += 1;
                    } else if (num === lastRevNum ||
                        num > lastRevNum && num <= lastNum) {
                        levelArr.push(0);
                        lastRevNum = lastRevNum;
                    } else if (num < lastRevNum) {
                        levelArr.push(num - lastRevNum);
                        lastRevNum = num;
                    }
                    count += levelArr[levelArr.length - 1];
                    lastNum = num;
                    elem.id = elem.id || (id + guid++);
                    titleId.push(elem.id);
                }
                if (count !== 0 && levelArr[0] === 1) levelArr[0] = 0;
                return levelArr;
            })(article, contentArr, titleId);
            currentList = root = document.createElement('ul');
            dirNum = [0];
            for (i = 0, len = levelArr.length; i < len; i++) {
                level = levelArr[i];
                if (level === 1) {
                    list = document.createElement('ul');
                    if (!currentList.lastElementChild) {
                        currentList.appendChild(document.createElement('li'));
                    }
                    currentList.lastElementChild.appendChild(list);
                    currentList = list;
                    dirNum.push(0);
                } else if (level < 0) {
                    level *= 2;
                    while (level++) {
                        if (level % 2) dirNum.pop();
                        currentList = currentList.parentNode;
                    }
                }
                dirNum[dirNum.length - 1]++;
                li = document.createElement('li');
                link = document.createElement('a');
                link.href = '#' + titleId[i];
                link.innerHTML = !isDirNum ? contentArr[i] :
                    dirNum.join('.') + ' ' + contentArr[i] ;
                li.appendChild(link);
                currentList.appendChild(li);
            }
            directory.appendChild(root);
        };
        createPostDirectory(document.getElementById('entry-content'),document.getElementById('post-dir'), true);
    };
    postDirectoryBuild();

    $(window).scroll(function(){
        var dirSelector = $('#post-dir');
        var top = $(document).scrollTop();
        var items = $('.entry-content').find('h1,h2,h3,h4,h5,h6');
        var currentId = '';

        items.each(function() {
            var m = $(this);
            var itemTop = m.offset().top;
            if ( top > itemTop - 180 ) {
                currentId = '#' + m.attr('id');
            } else {
                return false;
            }
        });

        var currentLink = dirSelector.find('.current');
        if (currentId && currentLink.attr('href') != currentId) {
            currentLink.removeClass('current');
            dirSelector.find('[href=' + currentId + ']').addClass('current');
            $('#post-dir ul ul').hide();
            $('#post-dir a.current').parents('ul').show();
            $('#post-dir a.current ~ ul').show();
        }

        var wide = $(window).width();
        if( top >= 320 && wide > 1072 ){
            $('#directory-wrap').fadeIn('slow');
        } else {
            $('#directory-wrap').hide();
        }

    });

    // Fix Post directory links position.
    $('#post-dir a').click(function() {
        var target = document.getElementById(this.hash.slice(1));
        if (!target) return;
        var targetOffset = $(target).offset().top - 80;
        $('html,body').animate({
            scrollTop: targetOffset
        },
        300);
        return false;
    });

})( jQuery );

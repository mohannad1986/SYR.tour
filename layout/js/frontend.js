$(function() {
    'use strict';

    //    اول ما اعمل فوكس عالبليس هولدر شو بصير 
    // رح ضيف نجمات جوا الحقل المطلوب
    // شيك على كل انبوت في الصفحة  
    $('input').each(function() {
        // لو عندك اتربيوت ريكوايرد وقيمتو تساوي ريكوايرد 
        if ($(this).attr('required') === 'required') {
            // حطلي بعدو نجمة وانا عطيتو للسبان كلاس استركس
            $(this).after('<span class="asterisk">*</span>');

        }
    });
    // الان زر الديليت هاد التابغ بيخليه يقلي هل انت متاكد ولا كر 
    // هالزر موجود بصفحة الميمبرز بقسم المانج  والكلاس اسمو كونفرم
    $('.confirm').click(function() {
        // رجعلي رسالة تاكيد  بتقول هل انت متوكد
        return confirm('Are you Sure ?');
        //  لو يس ح يكمل الاكشن بتاعي  لو نو بيضل مطرحو هك مبدا راسالة الكونفيرم 
    });

    // --------------------------------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------------
    //    ----------------------------صفحة اللوغ ان--------------------
    // ---------- التبديل بين السبانات لوع ان وساين اب---------------
    $('.login-page h1 span').click(function() {
        //    لمن دوس عالسبان الي جوا الاتش ون الي بكلاس اللوغ ان 
        //  هالسبان الي رح دوس عليها ضفلها كلاس سلكتد
        // والاشقاء تبعها يعني السبان الي جنبها شيل منو كلاس سلكتد 
        $(this).addClass('selected').siblings().removeClass('selected');
        // وهك غيرت لون الكلمات وانا بالسي اس اس حطيت اللون لاساسي مخفي ولون كلاس سلكتد محددد
        // وهك ظهرت كلمة لوغ ان واختف كلمة ساين اب 
        // ---------
        // اولا اي فورم  موجودة بكلاس اسمو لوغ ان بيج  اخفيها
        $('.login-page form').hide();
        //  بعدين اظهرلي  قي 100 ملم سكند 
        // يعني حولتو لسلكتور يعني صار كلاس عادي لمن ضغطت عليه فوق 
        // يعني اظهرلي الفورم الي الكلاس تبعها هو نفس الداتا كلاس تبع هي السبان الاساسية 
        $('.' + $(this).data('class')).fadeIn(100);

    });
    // ----------------------------------------------------------------------------

});
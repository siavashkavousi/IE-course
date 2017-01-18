<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "title" => "بررسی بازی Call of Duty: Infinite Warfare",
                "abstract" => "نسخه جدید سری Call of Duty به آینده‌ای دور رفته و همین گذر زمان، باعث شده تا از دوران اوج خود فاصله بگیرد. با زومجی و بررسی بازی Call of Duty: Infinite Warfare همراه باشید.",
                "info" => "قصه از جایی شروع می‌شود که در آینده‌ای تخیلی؛ خیلی خیلی دورتر از ما، رشد جمعیت، زیاده‌خواهی انسان‌ها و مشکلاتی که اکنون هم در حال تجربه آن‌ها هستیم سبب شده‌‌اند تا انسان‌ها پا را فراتر از این کره خاکی گذاشته و به فضا سفر کنند، سیاره‌های مختلف را تحت سلطه درآورند و همان تصمیمی را بگیرند که ما در تخیل و آینده احتمالی خودمان می‌بینیم؛ این‌که نه تنها زمین، بلکه منظومه شمسی را تحت تسلط خودمان دربیاوریم و بر آن حکمرانی کنیم. ",
                "rate" => 4.6,
                "large_image" => "http://cdn.zoomg.ir/2016/12/ecbef6aa-a03e-4bc6-8668-9fa7186ac9ef.jpeg",
                "small_image" => "http://cdn.zoomg.ir/2016/10/b4472213-741a-4810-be30-7f6d09e9421d-400x267.jpg",
            ],
            [
                "title" => "بررسی بازی Super Mario Run",
                "abstract" => "آیا ماریو، لوله‌کش محبوب دنیای بازی‌های ویدیویی، توانسته در اولین حضور خود در موبایل، به موفقیت دست پیدا کند؟",
                "info" => "مدت‌ها بود که بسیاری از گیمرها و تحلیلگران، از نینتندو این سوال را می‌پرسیدند که چرا هرگز وارد بازار پررونق بازی‌های موبایل نمی‌شود. تا اینکه سال گذشته بود که نینتندو اعلام کرد که قصد دارد وارد این بازار سودده شود و اولین اپلیکیشن خود را با نام Miitomo برای iOS و اندروید عرضه کرد. این اپلیکیشن، بازی نبود و بیشتر حالت یک پلتفرم اجتماعی را داشت. دیگر خبری از برنامه‌های نینتندو نبود تا اینکه اواخر تابستان سال ۲۰۱۶، اپل کنفرانس سالیانه خود را برای معرفی آیفون‌های جدید خود برگزار کرد. اما چیزی که به خصوص برای جامعه گیمرها این کنفرانس را تحت‌الشعاع قرار داد، حضور شیگرو میاموتو، خالق ماریو، در ابتدای این کنفرانس بود. وی با حضور خود برروی سن، اعلام کرد که اواخر سال ۲۰۱۶، ماریو، این لوله‌کش محبوب و دوست‌داشتنی دنیای بازی‌های ویدیویی، برای اولین بار پای خود را برروی گوشی‌های هوشمند باز می‌کند. بالاخره زمان موعود فرا رسید و در تاریخ ۲۵ آذر، این بازی برای iOS عرضه شد. اما این بازی چقدر توانسته در القای حس یک بازی ماریو موفق باشد و نینتندو در اولین تلاش خود برای پیاده‌سازی این شخصیت برروی گوشی‌های موبایل، چه نوآوری‌هایی را به کار گرفته است؟ با زومجی و بررسی بازی Super Mario Run همراه باشید. پیش از اینکه وارد جزئیات بازی شویم، لازم می‌دانم که چند نکته درباره Super Mario Run به شما بگویم. ممکن است با وارد شدن به اپ‌استور اپل، این بازی را به صورت «رایگان» ببینید، اما در اصل بازی رایگان نیست. شما با دانلود نسخه رایگان بازی، تنها به سه مرحله از بازی اصلی دسترسی پیدا می‌کنید و برای اینکه بتوانید به تمام مراحل بازی دسترسی پیدا کنید، باید ۹.۹۹ دلار از طریق پرداخت درون‌برنامه‌ای بپردازید. نکته دیگری که باید در نظر داشته باشید، این است که بازی نیازمند اتصال دائم به اینترنت است. این تصمیم نینتندو، کمی عجیب است زیرا بازی‌ای که حداقل در بخش داستانی خود هیچگونه المان آنلاینی ندارد، نیازی ندارد که همیشه به اینترنت متصل باشد. اما از این‌ها که بگذریم، به خود بازی سوپر ماریو ران می‌رسیم. در این بازی، بر خلاف دیگر بازی‌های دو بعدی ماریو، شما کنترلی برروی حرکت ماریو به سمت جلو ندارید. ماریو به طور خودکار به جلو راه می‌رود و شما باید با زدن برروی صفحه موبایل خود، سعی کنید که بپرید و سکه‌های مختلفی را جمع‌آوری کنید. تفاوت عمده دیگری که سوپر ماریو ران با دیگر بازی‌های این مجموعه دارد، در برخورد به دشمنان تعریف می‌شود. دیگر شما با برخورد به دشمنان بامزه ماریو، نمی‌میرید و ماریو خود به صورت خودکار از روی آنها می‌پرد. با این حال لمس کردن صفحه در هنگامی که ماریو در حال عبور از دشمنان است، باعث می‌شود که آنها کشته شوند و ماریو پرش بلندتری داشته باشد. بازی از سه بخش اصلی World Tour، Kingdom Builder و Toad Rally تشکیل شده است. بخش اصلی بازی یا همان World Tour، جایی است که شما بیشترین زمان خود را می‌گذرانید. ۶ دنیا که هر کدام شامل چهار مرحله می‌شوند، در این بخش از بازی وجود دارند. هدف اصلی ماریو هم در این بازی مانند اکثر بازی‌های این مجموعه، نجات پرنسس پیچ از دست باوزر بدجنس است. سه مرحله اول هر دنیا، مراحل معمولی محسوب می‌شوند و مرحله آخر در حقیقت مرحله‌ی باس بازی است و شما با به اتمام رساندن مرحله، باید با باس آن دنیا روبه‌رو شوید. یکی از نکات نه چندان خوب بازی، عدم تنوع در گیم‌پلی باس‌فایت‌ها است. بوم-بوم و باوزر، تنها باس‌های این بازی محسوب می‌شوند و به غیر از باس آخرین مرحله بازی، گیم‌پلی تمامی آنها شبیه به هم است. ",
                "rate" => 5,
                "large_image" => "http://cdn.zoomg.ir/2016/12/113277e9-9494-4b9d-a28d-f0337242405a.jpg",
                "small_image" => "http://cdn.zoomg.ir/2016/12/113277e9-9494-4b9d-a28d-f0337242405a.jpg",
            ],
            [
                "title" => "بازی مین روب",
                "abstract" => "یکی از قابلیت های ویندوز قدیمی XP و دیگر ویندوز ها دارا بودن چندین بازی زیبا و سرگرم کننده بصورت پیش فرض است که اگر یکی از کاربران ویندوز های قدیمی XP و ویندوز ۹۸ بوده باشید حتما با بازی محبوب و نوستالژیک مین روب یا همون Minesweeper آشنا هستید",
                "info" => "مین روب ( Minesweeper ) یک بازی ساده، جذاب و در عین حال فکری است که وظیفه ی شما در این بازی پیدا کردن و علامت گذاری مین ها در کمترین زمان ممکن می باشد. به زبان ساده تر شما باید با استفاده از عدد هایی که در برخی خانه ها برایتان نمایش داده می شود مین ها را تشخیص داده و علامت گذاری کنید. این بازی برای کاربران ویندوز ۹۸ و XP بسیار محبوب بود و در مواقع استراحت خود را با آن سرگرم می کردند.
جالب است بدانید که شکل و شمایل بازی Minesweeper رفته رفته در نسخه های ویندوز تغییر نمود و پس از انتشار ویندوز ۸ و ۱۰ این بازی های پیشفرض از روی ویندوز حذف شدند که برای اجرای آن ها نیاز است از فروشگاه مایکروسافت اقدام به نصب نسخه بروز و جدید بازی Minesweeper کنید.
امروز نسخه قدیمی بازی مین روب Minesweeper (ورژن ویندوز XP) را برای شما آماده نموده ایم که می توانید آن را بر روی تمامی ویندوز ها از جمله ویندوز ۱۰ نصب نمایید. در ادامه با ترفندها همراه باشید.
 

تاریخچه بازی مین روب Minesweeper
مین روب Minesweeper یک بازی رایانه است که در ابتدا توسط کورت جانسون و برای سیستم عامل OS/2 منتشر گردید. این بازی سپس به سیستم عامل ویندوز منتقل و در سال ۱۹۹۰ میلادی به عنوان بخشی از بسته ی Microsoft Entertainment Pack 1 منتشر شد.
اما جالب است بدانید که بازی مین روب در سال ۱۹۹۲ میلادی به صورت پیشفرض بر روی Windows 3.1 گنجانده شد و تا ویندوز ۷ بر روی این سیستم عامل قرار داشت. پس از انتشار ویندوز ۸ و ۱۰ بخش بازی های پیشفرض ویندوز از روی این سیستم عامل حذف گردید و کاربران می بایست نسخه بروز آن را از فروشگاه مایکروسافت دانلود و نصب نمایند.",
                "rate" => 3.5,
                "large_image" => "http://tarfandha.net/wp-content/uploads/2016/08/Minesweeper_XP.png",
                "small_image" => "http://tarfandha.net/wp-content/uploads/2016/08/Minesweeper_XP.png",
            ],
        ];
        DB::table('games')->insert(attach_timestamps($data));
    }
}

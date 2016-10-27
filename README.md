# Tiyse Template Engine v.3.0.0
Merhaba, geliştiriciler tiyse tema motorunu geliştirmemin sebebi az kod çok iş ve karmaşanın engellenmesi algoritmik bir yapının kullananılması için hazırlamış olduğum bir operasyon yöntetim sistemidir.

Oldukça başarılı hızlı bir yapıya sahip ayrıca alt yapılandırması ileriye yönelik stabil ve geliştirilebilir çalışmaktadır. Majör, Minor, Bug Fix, Build... gibi değişimleri version üzerinden belirtilecektir.

Sınıf dosyasında değişiklik yapmaz iseniz güncellemeleri sorunsuz yapabilirsiniz. Geliştirme esnasında mevcut fonksiyonu modellerken kullanabileceğiniz veya kullanmış olduğunuz yapıya göre güncellemeleri sağlayacağım.

## SINIF ÖZELLİKLERİ
<ul>
  <li>ZLIB sıkıştırma algoritması</li>
  <li>Kaynak kod sıkıştırma</li>
  <li>Sıkıştırılmış önbellekleme</li>
  <li>Şablon değiştirici ve operasyon</li>
  <li>Stabil, performans ve hız</li>
</ul>

## KURULUM

```php
<?php

include_once( __DIR__ ."/tiyse.tpl.class.php");

$tiyse = new tiyse();
$tiyse->assign("{title}","Merhaba Dünyalı!");
$tiyse->draw("main");

?>
```

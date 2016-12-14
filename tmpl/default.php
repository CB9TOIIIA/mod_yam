<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_yam
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require dirname(__FILE__) . '/../vendor/autoload.php';
require_once __DIR__ . '/../helper.php';
?>

<div class="allmetrika">
<h3 class="metrika">
<img class="image" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKUAAAAgCAMAAABEiEiDAAAAk1BMVEX///8AAAB/f38/Pz+/v7//AADv7+//Pz/Pz8/f398QEBAPDw9PT09vb29fX1+Pj4+vr68fHx8gICCfn58vLy9AQEDAwMAwMDCAgID/f3//v7//QED/Hx//j4//n59QUFD/Dw9gYGBwcHD/39//7+//EBD/Ly//X1//YGCQkJD/b2//r6//MDD/T0//cHCwsLD/kJD/UgWcAAAD0UlEQVRYw+3XZ3PkKBAG4PeFBivnCQ7nvHkv/P9fdx9aIGkshy1r626rlg8uFZ6BR03TMMDv9rv9j9vDP39dXl5+fe8w/U7Gp3K3ufHxs3POOXf23oEMzfhEplsrPzp3dn5+tYEyt/ogpGyMPHfuDwBn71cWliO33Vx5q7wNlLYacdZurbzQUG6iNLkmJs3WymvnLt6k3Pu13mQ/VxZW07IJymT1W/v9K6j9Pn2SljMlaeJfQ20AgHuSO6+9AGrmKeDvSGZmUtYEADOkrAEgPZBZP41EA6EkHXnwGnMAwM4CsBYAEjbAl4zkIZkrv71JWZI5uQtKn9EA/kDmpJ2UCQWALXV+fxhSVEyQisgwiEgKYdPWkHw3KYVR6Q8lIDQpmqF7Pi+XShtCl5D9WF8MCRjmHqjIHujrMBQNcgOAjc5f5x7AUI07aixSXaNJEZVFHpXl4AEviJ+I7cp9f1VZsQXQstSOMZRktUgeCooCEHqd/1ACgGbBpCwAAG0VlCmLoGw4W+Z4RITE/Pz4ivLAEoANHRrKnkxOlXUGmEGnSDUaop+KSg1R1QVIVdlR6bMazynxybkPl5cfXlKGjgwwpM9Ya67iVJkwgS11CtFjUnS/R6WMpynCu6RBubN4Xonz6Rwn7/b7/akyIW+Ox+NOU5KGLQBYDk+UyGuwAVo7Qp5T1kFZFhiVdR7Lz9/H43FFeX3xcVSGkgEUIQ0hoVuVmQ5guXh3eApQFEKvplh/1pRCAWjgMxmVA8txoCZrrTGnylt3NuVla61VpaWZlJUxxhjtsOzWlMIEqLM67AVD0eZXlM0YS2MRYllkGstEuSfKa+eu13ZPx35SynQ9o5A9gBE7UwJIWJmoXByf63mZNVHptYiiaNfy8spdrVUiP5XHlNNXDAnLTMvlUyVyLew2bu4XlX2LqESjJ1ZWrii/zW9uM6WQmPZ4NVcmpAHqk0qkyoLBlCzq8omysABoun6mhK45zYryzN0+rilLDlFZMPMzJSpmHiljvs+U0uuJCiCvnldmBgB1caNS11wvVulCeeHc19Wzp2MdlULeefijWaSAZSaBBaDn/McFgFJfTZbK8UBKAYw3lahEwwYoOgC4yefKP517WFNyagJU+tRNRyZTpDnZZXEPmfxE6fNDivSeyz3OL4Aoj7lfKlFkHsIjcG/tbKEenPuE15UwOUkbthPSnBWQFiTbkH3GniiRtCTbk1jWA7lMvZnS5zdaaK2v7Btux7H4hIdEVi60XpIXR0lO/y+U9ZF+ZNQXlNs02fa3xq+hlLAs8tr6/JfKn9R+XPkv+5cjbuUzVnUAAAAASUVORK5CYII=" alt="metrika"> <?php echo ' &mdash; '.$text30; ?></h3>

<?php

if ($legendpv == 1)  : ?>
  <div class="legenda">
  <p><span class="pv"></span> &mdash; Просмотры</p>
  <p><span class="users"></span> &mdash; Посетители</p>
  </div>
<?php endif; ?>

<div class='ct-chart'></div>

<h3 class="sevendates"><?php echo $text7; ?></h3>
<table id="accountTable7days" class="table">
<thead>

<?php
$hitSar = array();

if (!is_null($WeekWeekVISITS->getData())) {
  foreach ($WeekWeekVISITS->getData() as $dimensions) {
    $metrics = current($dimensions->getMetrics());
    for ($i = 0; $i < count($metrics); $i++) {
      $hitSar[] = $metrics[$i];
    }
  }
}

$begin = new DateTime($WeekWeekVIEWS->getQuery()->getDate1());
$end = new DateTime($WeekWeekVIEWS->getQuery()->getDate2());
$end = $end->modify('+1 day');
$interval = new DateInterval('P1D');
$dateRange = new DatePeriod($begin, $interval, $end);

foreach ($dateRange as $date) { ?>
  <td class="headdate"><?php echo $date->format('d.m.Y') ?></td>
  <?php } ?>
</thead>
<tbody>
  <?php
  if (!is_null($WeekWeekVIEWS->getData())) {
    foreach ($WeekWeekVIEWS->getData() as $dimensions) {
      $metrics = current($dimensions->getMetrics()); ?>
      <tr>
        <?php for ($i = 0; $i < count($metrics); $i++) { ?>
          <td><?php echo $metrics[$i].' / '.$hitSar[$i] ?>

            <?php if ($i == 7): ?>
              <span class="svgpul"><svg width="16" height="20" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="#ccc">
                <g transform="matrix(1 0 0 -1 0 80)">
                  <rect width="10" height="71.6202" rx="3">
                    <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                  </rect>
                  <rect x="15" width="10" height="56.3333" rx="3">
                    <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                  </rect>
                  <rect x="30" width="10" height="35" rx="3">
                    <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                  </rect>
                  <rect x="45" width="10" height="57.9167" rx="3">
                    <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                  </rect>
                </g>
              </svg></span>
            <?php endif; ?>

          </td>
          <?php } ?>
        </tr>
        <?php
      }
    }
    ?>
</tbody>
</table>
</div>

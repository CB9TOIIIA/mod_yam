<?php
defined('_JEXEC') or die;

$counterId = $params->get('counter_id');
$app_token = $params->get('app_token');
$threshold = $params->get('threshold');
$text7 = $params->get('text7');
$text30 = $params->get('text30');
$legendpv = $params->get('legendpv');

define('ACCESS_TOKEN', $app_token);

use Yandex\Metrica\Stat\StatClient;
$statClient = new StatClient(ACCESS_TOKEN);

$document = JFactory::getDocument();
$document->addScript(JUri::root().'modules/mod_yam/assets/js/chart.js');
$document->addStyleSheet(JUri::root().'modules/mod_yam/assets/css/chartist.min.css');

$paramsMonthThree = new Yandex\Metrica\Stat\Models\ByTimeParams();
$paramsMonthThree
->setMetrics(\Yandex\Metrica\Stat\MetricConst::S_PAGE_VIEWS)
->setDate1('31daysAgo')
->setDate2('1daysAgo')
->setGroup('day')
->setId($counterId);
$MonthThreeMonth = $statClient->data()->getByTime($paramsMonthThree);

$paramsMonthThreeS_VISITS = new Yandex\Metrica\Stat\Models\ByTimeParams();
$paramsMonthThreeS_VISITS
->setMetrics(\Yandex\Metrica\Stat\MetricConst::S_VISITS)
->setDate1('31daysAgo')
->setDate2('1daysAgo')
->setGroup('day')
->setId($counterId);
$MonthThreeMonthS_VISITS = $statClient->data()->getByTime($paramsMonthThreeS_VISITS);

$paramsWeekVIEWS = new Yandex\Metrica\Stat\Models\ByTimeParams();
$paramsWeekVIEWS
    ->setMetrics(\Yandex\Metrica\Stat\MetricConst::S_PAGE_VIEWS)
    ->setDate1('7daysAgo')
    ->setDate2('today')
    ->setGroup('day')
    ->setId($counterId);
$WeekWeekVIEWS = $statClient->data()->getByTime($paramsWeekVIEWS);

$paramsWeekVISITS = new Yandex\Metrica\Stat\Models\ByTimeParams();
$paramsWeekVISITS
    ->setMetrics(\Yandex\Metrica\Stat\MetricConst::S_VISITS)
    ->setDate1('7daysAgo')
    ->setDate2('today')
    ->setGroup('day')
    ->setId($counterId);
$WeekWeekVISITS = $statClient->data()->getByTime($paramsWeekVISITS);

$begin = new DateTime($MonthThreeMonth->getQuery()->getDate1());
$end = new DateTime($MonthThreeMonth->getQuery()->getDate2());
$end = $end->modify('+1 day');
$interval = new DateInterval('P1D');
$itemmonth1  = array();
$itemmonth2  = array();
$dateRange = new DatePeriod($begin, $interval, $end);

foreach ($dateRange as $date) {
$datenum = $date->format('d');
$itemmonth1[] = '"'.$datenum.'"';
}

if (!is_null($MonthThreeMonth->getData())) {
  foreach ($MonthThreeMonth->getData() as $dimensions) {
    $metrics = current($dimensions->getMetrics());
    for ($i = 0; $i < count($metrics); $i++) {
      $itemmonth2[] = $metrics[$i];
    }
  }
}

$itemmonth1 = implode(', ',$itemmonth1);
$itemmonth2 = implode(', ',$itemmonth2);

$begin = new DateTime($MonthThreeMonthS_VISITS->getQuery()->getDate1());
$end = new DateTime($MonthThreeMonthS_VISITS->getQuery()->getDate2());
$end = $end->modify('+1 day');
$interval = new DateInterval('P1D');
$itemmonth1S_VISITS  = array();
$itemmonth2S_VISITS  = array();
$dateRange = new DatePeriod($begin, $interval, $end);

foreach ($dateRange as $date) {
$datenum = $date->format('d');
$itemmonth1S_VISITS[] = '"'.$datenum.'"';
}

if (!is_null($MonthThreeMonthS_VISITS->getData())) {
  foreach ($MonthThreeMonthS_VISITS->getData() as $dimensions) {
    $metrics = current($dimensions->getMetrics());
    for ($i = 0; $i < count($metrics); $i++) {
      $itemmonth2S_VISITS[] = $metrics[$i];
    }
  }
}

$itemmonth1S_VISITS = implode(', ',$itemmonth1S_VISITS);
$itemmonth2S_VISITS = implode(', ',$itemmonth2S_VISITS);

echo "<script type='text/javascript'>";
echo " document.addEventListener('DOMContentLoaded',function(){";
echo 'new Chartist.Line(".ct-chart", { ';
echo "labels: [".$itemmonth1."],";
echo "series: [   [".$itemmonth2."], [".$itemmonth2S_VISITS."]  ]";
echo "     }, { ";
echo "      low: 0, ";
echo "       showArea: true, ";
echo "  plugins: [
Chartist.plugins.tooltip(),
Chartist.plugins.ctThreshold({
threshold: {$threshold}
})
] ";
echo " }); ";
echo " }); ";
echo "</script>";

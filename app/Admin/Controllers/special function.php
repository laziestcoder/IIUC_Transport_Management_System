protected function calculate()
{
$datas = StudentSchedule::all();
$routes = BusRoute::all();
$points = BusPoint::all();
$days = Day::all();
$times = Time::all();

$dayid = 0;
$routeid = 0;
$pointid = 0;
$timeid = 0;
$gender = 0;

foreach ($days as $day) {
foreach ($points as $point) {
foreach ($times as $time) {
for ($genderid = 0; $genderid <= 1; $genderid++) {
$studentNumber =
StudentSchedule::where('day', $day->id)
->where('pickpoint', $point->id)
->where('picktime', $time->id)
->where('user_gender', $genderid)
->count();
if($studentNumber>0) {
$routeid = BusRoute::where('id', $point->routeid)->first()->id;
$pointid = $point->id;
$dayid = $day->id;
$timeid = $time->id;
$gender = $genderid;
$exist = BusStudentInfo::where('dayid', $pointid)
->where('routeid', $routeid)
->where('pointid', $pointid)
->where('timeid', $timeid)
->where('gender', $gender)
->get();
if (count($exist) > 0) {
$dataid = $exist->first()->id;
$form = BusStudentInfo::find($dataid);

$form->number = $routeid;
$form->number = $pointid;
$form->number = $studentNumber;
$form->number = $dayid;
$form->number = $timeid;
$form->switch = $gender;

$form->save();

} else {
$form = new BusStudentInfo;

$form->routeid = $routeid;
$form->pointid = $pointid;
$form->studentno = $studentNumber;
$form->dayid = $dayid;
$form->timeid = $timeid;
$form->gender = $gender;

$form->save();
}
}
}
}
}
}

}
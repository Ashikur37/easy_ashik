<option value="">{{$lng->ChooseChildCategory}}</option>
@foreach($childCategories as $childCategory)
<option value="{{$childCategory->id}}">{{$childCategory->name}}</option>
@endforeach 
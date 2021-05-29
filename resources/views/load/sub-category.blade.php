<option value="">{{$lng->ChooseSubCategory}}</option>
@foreach($subCategories as $subCategory)
<option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
@endforeach
<!-- Assuming $contact is an instance of the Contact model -->
<input type="hidden" name="notable_id" id="notable_id" value="{{$contact->id}}">
<!-- Corrected model name with proper namespace -->
<input type="hidden" name="notable_type" id="notable_type" value="App\Models\Contact">
<div class="document_note_body">
</div>

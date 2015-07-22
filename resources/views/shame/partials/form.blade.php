<div class="form-group">
	{!! Form::label('title', 'Title') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('markdown', 'Content') !!}
	{!! Form::textarea('markdown', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	<div class="form-inline">

		<div class="form-group">
			{!! Form::label('tags', 'Tags: ', ['class' => 'sr-only']) !!}
			{!! Form::text('tags', null, ['class' => 'form-control', 'placeholder' => 'Tags', 'size' => '60']) !!}
		</div>

		<div class="checkbox">
			<label>
				{!! Form::checkbox('is_anonymous', '1', true) !!} Post Anonymously?
			</label>
		</div>

	</div>
</div>

{!! Form::submit($submit_button_text, ['class' => 'btn btn-primary']) !!}
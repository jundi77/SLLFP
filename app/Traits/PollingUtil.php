<?php

namespace App\Traits;

use App\Models\Poll;

trait PollingUtil
{
	public function polls()
	{
		return $this->belongsToMany(Poll::class, 'author_id');
	}

	public function votes()
	{
		return $this->belongsToMany(Poll::class, 'respondent_id');
	}
}
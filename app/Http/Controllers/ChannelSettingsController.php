<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\ChannelUpdateRequest;
#use App\Jobs\UploadImage;

class ChannelSettingsController extends Controller
{
    public function edit(Channel $channel)
    {

        $this->authorize('edit', $channel);

        return view('channel.settings.edit', [
            'channel' => $channel
        ]);
    }

    public function update(ChannelUpdateRequest $request, Channel $channel)
    {

        $this->authorize('update', $channel);
    }
}

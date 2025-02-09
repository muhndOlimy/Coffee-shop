<?php

declare(strict_types=1);

namespace Services;

use Models\Entities\Feedback;
use Models\Requests\FeedbackRequest;
use Repositories\Repository;

readonly class FeedbackService
{
    /** @param Repository<Feedback> $feedbackRepo */
    public function __construct(private Repository $feedbackRepo)
    {
    }

    public function submit(FeedbackRequest $request): Feedback
    {
        $feedback = new Feedback();
        $feedback->email = $request->email;
        $feedback->name = $request->name;
        $feedback->message = $request->message;

        $feedback->id = $this->feedbackRepo->insert([$feedback]);
        return $feedback;
    }
}

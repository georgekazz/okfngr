<div class="comment" id="comment-{{ $comment->id }}">
    <div class="comment-avatar">
        <div class="avatar-circle">
            {{ strtoupper(substr($comment->author_name, 0, 1)) }}
        </div>
    </div>
    <div class="comment-body">
        <div class="comment-header">
            <strong class="comment-author">{{ $comment->author_name }}</strong>
            <span class="comment-date">{{ $comment->created_at->locale(app()->getLocale())->diffForHumans() }}</span>
        </div>
        <div class="comment-content">
            {{ $comment->content }}
        </div>
        @if($comment->approvedReplies->count() > 0)
        <div class="comment-replies">
            @foreach($comment->approvedReplies as $reply)
                @include('partials.comment', ['comment' => $reply])
            @endforeach
        </div>
        @endif
    </div>
</div>

<style>
.comment {
    display: flex;
    gap: 1.5rem;
    padding: 2rem 0;
    border-bottom: 1px solid var(--border);
}

.comment-avatar {
    flex-shrink: 0;
}

.avatar-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--gradient-cyber);
    color: var(--light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
}

.comment-body {
    flex: 1;
}

.comment-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.75rem;
}

.comment-author {
    font-size: 1.1rem;
    color: var(--text-primary);
}

.comment-date {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.comment-content {
    color: var(--text-primary);
    line-height: 1.7;
    margin-bottom: 1rem;
}

.comment-replies {
    margin-left: 2rem;
    margin-top: 1.5rem;
    padding-left: 2rem;
    border-left: 2px solid var(--border);
}
</style>
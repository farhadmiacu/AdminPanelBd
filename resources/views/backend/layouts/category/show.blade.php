protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->slug)) {
            $model->slug = Str::slug($model->name);
        }
    });

    static::updating(function ($model) {
        if ($model->isDirty('name') && empty($model->slug)) {
            $model->slug = Str::slug($model->name);
        }
    });
}

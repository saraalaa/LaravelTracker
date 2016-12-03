<?php namespace Arcanedev\LaravelTracker\Models;

/**
 * Class     Referrer
 *
 * @package  Arcanedev\LaravelTracker\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int             id
 * @property  int             domain_id
 * @property  string          url
 * @property  string          host
 * @property  string          medium
 * @property  string          source
 * @property  string          search_terms_hash
 * @property  \Carbon\Carbon  created_at
 * @property  \Carbon\Carbon  updated_at
 *
 * @property  \Arcanedev\LaravelTracker\Models\Domain  domain
 */
class Referrer extends Model
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'referrers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'host',
        'domain_id',
        'medium',
        'source',
        'search_terms_hash',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'domain_id' => 'integer',
    ];

    /* ------------------------------------------------------------------------------------------------
     |  Relationships
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Domain relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function domain()
    {
        return $this->belongsTo(
            $this->getConfig('models.domain', Domain::class)
        );
    }
}
<?phpnamespace App;use Illuminate\Database\Eloquent\Model;use Symfony\Component\HttpFoundation\File\UploadedFile; use Image; class Photo extends Model{    protected $fillable = array('path', 'name', 'thumbnail_path');    protected $table = 'flyer_photos';     protected $file;     public static function boot()    {        static::creating(function ($photo){          return $photo->upload();         });     }        /**     * [flyer description]     * @return [type] [description]     */    public function flyer()    {    	return $this->belongsTo('App\Flyer', 'flyer_id');     }    public function fileName()    {        $name =  sha1(time() . $this->file->getClientOriginalName());               $extension = $this->file->getClientOriginalExtension();         return "{$name}.{$extension}";     }    public function filePath()    {        return $this->baseDir() . '/' . $this->fileName();     }    public function thumbnailPath()    {        return $this->baseDir() . '/tn-' . $this->fileName();     }    public function baseDir()    {        return 'flyer/photos';     }    //UploadedFile $file    public function upload()    {        $this->file->move($this->baseDir(), $this->fileName());         $this->makeThumbnail();                 return $this;     }    public static function fromFile(UploadedFile $file)    {        $photo = new static;         $photo->file = $file;                 return $photo->fill([                'name' => $photo->fileName(),                 'path' => $photo->filePath(),                 'thumbnail_path' => $photo->thumbnailPath()            ]);     }    public function makeThumbnail()    {        Image::make($this->filePath())        ->fit(200)        ->save($this->thumbnailPath());         return $this;     }}
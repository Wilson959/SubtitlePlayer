# SubtitlePlayer
SubtitlePlayer is a simple script wich add Subtitles to various video hosting sites,
how it work? in fullscreen responsive iframe page it display video and CC button.
on button click it first check if subtitle exist on server if not it upload it.
it use subtitles from opensubtitles and upload them to your server.
and append it to iframe.
currently it support those video hosting sites : netu, streamwish, streamtape, filemoon, vidhide, vidguard
since opensubtitles limit subtitles download, download is done on clienst side and then uploaded to server.
you can use single or multiple languages, you can use tmd or imdb id.
basicly you open page like this: player.html?imdb=tt6263850&url=VIDEO_EMBED_URL&language=eng,rum,ger,fre,ara,spa,por or player.html?tmdb=889737&url=VIDEO_EMBED_URL&language=eng,hrv,bos,scc

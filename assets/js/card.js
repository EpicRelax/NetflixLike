class CardsFrame extends React.Component {
  constructor(props) {
    super(props);
    this.state = {films:props.filmsProps, dCard:props.displayCard}
    
  }

  render() {

    return (
      <div className="cardsFrame">
        {
          this.state.films.map((value,index)=>{
            return <Card info={value} key={index} dCard={this.state.dCard} url={this.props.url} xhrUrl={this.props.xhrUrl}/>
          })
        }
      </div>
    )
  }
}

function Card(props) {
  function goToSingle(id_movie){
    location.href = props.url + "?id_movie=";
  }
  function addToPref(id_movie){
    fetch(props.xhrUrl+"?id_movie="+ id_movie +"&id_user="+props.session_id).then(
      (response)=>response.text()
    ).then((result)=>console.log(result))
  }
  return (
    <div className="card mb-3">
      <h3 className="card-header" id="title">{props.info.title}</h3>
      <img className="imgFilm" src={props.info.urlFilm} alt="" />
      <div className="card-body">
        <p className="card-text" id="plot">{props.info.plot}</p>
      </div>
      <ul className="list-group list-group-flush">
        <li className="list-group-item" id="year">{props.info.year}</li>
        <li className="list-group-item" id="genre">{props.info.genres}</li>
        <li className="list-group-item" id="directors">{props.info.directors}</li>
        <li className="list-group-item" id="cast">{props.info.cast}</li>
      </ul>
      {props.dCard ? <button type="button" className="btn btn-secondary" onClick={()=>{goToSingle(props.info.id_movie)}}>INFOS</button> : ""}
      <button type="button" className="btn btn-danger" onClick={()=>{addToPref(props.info.id_movie)}} >LIKE</button>
    </div>
  )
}

ReactDOM.render(<CardsFrame filmsProps={films} displayCard={dCard} url={url} xhrUrl={xhrUrl}></CardsFrame>, document.getElementById('cardsFilms'));

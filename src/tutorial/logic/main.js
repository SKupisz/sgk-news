let e = React.createElement;

class Question extends React.Component {
  constructor(props) {
    super(props);
    this.openRef = React.createRef();
    this.contentRef = React.createRef();

    this.Opening = this.Opening.bind();
  }
  Opening(){
    let dir = event.target.parentNode.childNodes[1].classList;
    if(dir.contains("hidden")){
        dir.remove("hidden");
    }
    else{
        dir.add("hidden");
    }
    
  }
  render(){
      let questionName = React.createElement("div",{className: "question-content", ref: this.openRef, onClick: () => this.Opening()},this.props.title);
      let questionAns = React.createElement("div",{className: "question-anwser hidden", ref: this.contentRef},this.props.anwser);
      return e(
          "div",{className: "question-container"},[questionName,questionAns]
      );
  }    
}
class List extends React.Component{
    constructor(props){
        super(props);
    }
    render(){
        return(
            <div className="list-container">
                <Question title = "How to start?" anwser = "That's simple. At first, go on register page. After setting up the account, if you want to create some content, go to 'Your articles' section. If you want to watch the content, go to the 'Articles' section, and enjoy."/>
                <Question title = "How to us the 'Your articles' section?" anwser = "The being written section is reserved for these articles you've already written, but you aren't sure if you have finished it yet. In the 'sent' section, as the name of it says, you can see statistics of your articles. The 'Write an article' part is a place where you can create on your own - articles, pictures, sounds, brief pick and mix"/>
            </div>
        )
    }
}

const domContainer = document.querySelector('#tutorials');
ReactDOM.render(<List/>, domContainer);
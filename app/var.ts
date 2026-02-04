import { useState, useRef } from 'react';
import { useTheme } from "next-themes"

export function varVarious(){

    // various variable
    const [theme, setThemeColor] = useState('light');
    const { setTheme } = useTheme();
    const [pages, setPages] = useState('login');

    return {
        theme,
        setThemeColor,
        setTheme,
        pages,
        setPages
    }
}
export function varLogin(){
    // login variable
    const [PageUser, setPageUser] = useState('Login');
    const [Joueur, setJoueur] = useState<any[]>([]);

    const login_email = useRef<any>(null);
    const login_MDP = useRef<any>(null);

    const Registre_Pseudo = useRef<any>(null);
    const Registre_email = useRef<any>(null);
    const Registre_MDP = useRef<any>(null);
    const Registre_Verif_MDP = useRef<any>(null);
    const [Erreur_Formulaire_inscription, setErreur_Formulaire_Inscription] = useState<any>('false');

    return {
        PageUser,
        setPageUser,
        Joueur,
        setJoueur,
        login_email,
        login_MDP,
        Registre_Pseudo,
        Registre_email,
        Registre_MDP,
        Registre_Verif_MDP,
        Erreur_Formulaire_inscription,
        setErreur_Formulaire_Inscription
    }
}
export function varClassement(){
    // classement variable
    const [Classement, setClassement] = useState<any[]>([]);

    return {
        Classement,
        setClassement
    }
}
export function varQuestionnaire(){
    // questionnaire variable
    const tempsAvantQuestion = 3000;
    const espaceDébut = 5;
    const [questions, setQuestions] = useState<any[]>([]);
    const [questionIndex, setQuestionIndex] = useState(0);
    const [explication, setExplication] = useState("");
    const [afficherExplication, setAfficherExplication] = useState(false);
    const [boutonProchaineQuestion, setboutonProchaineQuestion] = useState(true);
    const [réponseDonné, setréponseDonné] = useState(-1);
    const [questionProgress, setquestionProgress] = useState(espaceDébut);
    const [questionRépondue, setquestionRépondue] = useState(false);
    const question = questions[questionIndex];

    const [EtatQuestionnaire, setEtatQuestionnaire] = useState('stop');
    const [Score, setScore] = useState(0);
    const [TimeQuestion, setTimeQuestion] = useState(0);
  
    return {
        tempsAvantQuestion,
        espaceDébut,
        questions,
        setQuestions,
        questionIndex,
        setQuestionIndex,
        explication,
        setExplication,
        afficherExplication,
        setAfficherExplication,
        boutonProchaineQuestion,
        setboutonProchaineQuestion,
        réponseDonné,
        setréponseDonné,
        questionProgress,
        setquestionProgress,
        questionRépondue,
        setquestionRépondue,
        question,
        EtatQuestionnaire,
        setEtatQuestionnaire,
        Score,
        setScore,
        TimeQuestion,
        setTimeQuestion
    }
}
export function varAdmin(){
    // admin var
    const [sous_menu, setsous_menu] = useState('Statistique');
    const [joueurs, setjoueurs] = useState<any[]>([]);

    const Question_name = useRef<any>(null);
    const Question_proposition1 = useRef<any>(null);
    const Question_proposition2 = useRef<any>(null);
    const Question_proposition3 = useRef<any>(null);
    const Question_correct = useRef<any>(null);
    const Question_niveau = useRef<any>(null);
    const Question_credit_nom = useRef<any>(null);
    const Question_credit_url = useRef<any>(null);
    const Question_explication = useRef<any>(null);
    

    return {
        sous_menu,
        setsous_menu,
        joueurs,
        setjoueurs,
        Question_name,
        Question_proposition1,
        Question_proposition2,
        Question_proposition3,
        Question_correct,
        Question_niveau,
        Question_credit_nom,
        Question_credit_url,
        Question_explication
    }
}
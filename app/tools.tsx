// Components
import { Card } from "@/components/ui/card";
import { Spinner } from "@/components/ui/spinner"
import {Empty,EmptyDescription,EmptyHeader,EmptyMedia,EmptyTitle,} from "@/components/ui/empty"
import { NavigationMenu, NavigationMenuList, NavigationMenuItem, navigationMenuTriggerStyle } from "@/components/ui/navigation-menu"
import { Label } from "@/components/ui/label"
import { NavigationMenuLink } from '@radix-ui/react-navigation-menu';

export function chargement(section:string) {
    return (
        <section id="chargement-section">
        <Card className="max-w-4xl mx-auto mt-10">
            <Empty className="w-full">
            <EmptyHeader>
                <EmptyMedia variant="icon">
                <Spinner />
                </EmptyMedia>
                <EmptyTitle>Chargement du {section}...</EmptyTitle>
                <EmptyDescription>
                Le Chargement peut durer un certain temps.
                </EmptyDescription>
            </EmptyHeader>
            </Empty>
        </Card>
        </section>
    );
}

export function element_menu(page:string, pages:string) {
    return (
        <NavigationMenuLink asChild className={pages === page ? 'font-bold underline' : ''} onClick={() => changePages(page)}>
            <Label className={navigationMenuTriggerStyle()}>
            {page}
            </Label>
        </NavigationMenuLink>
    );
}

export function menu(pages:string,Joueur:any) {
    return (
          <NavigationMenu>
            <NavigationMenuList className="flex-wrap">
              <NavigationMenuItem className='space-x-3'>

                {element_menu('Questionnaire',pages)}

                {element_menu('Classement',pages)}
                
                {element_menu('Profil',pages)}
                
                {Joueur.map((entry) => (
                  <div>
                    {entry.Administrateur == true ?(
                      element_menu('Admin',pages)
                      ):null}
                    </div>
                  ))
                }

                <NavigationMenuLink asChild>
                  <Label htmlFor="theme" className={navigationMenuTriggerStyle()}>
                    <Switch onClick={changeTheme()} id='theme'/>
                    {theme} Mode
                  </Label>
                </NavigationMenuLink>

              </NavigationMenuItem>
            </NavigationMenuList>
          </NavigationMenu>
    );
}
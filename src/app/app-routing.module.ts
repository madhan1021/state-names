import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { stateComponent } from './state/state.component';

const routes: Routes = [
  {path : '', component:stateComponent},
  // {path : 'dialog', component:stateComponent},

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

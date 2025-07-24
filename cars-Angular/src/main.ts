import { Component } from '@angular/core';
import { bootstrapApplication } from '@angular/platform-browser';
import { Cars } from './app/cars/cars';
import { provideHttpClient } from '@angular/common/http';

@Component({
  selector: 'app-root',
  imports: [Cars],
  template: `<app-cars></app-cars>`,
})
export class App {
  name = 'Angular';
}

bootstrapApplication(App, {
  providers: [provideHttpClient()],
});
